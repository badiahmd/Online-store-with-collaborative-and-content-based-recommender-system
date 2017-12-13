import java.io.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.stream.Collectors;

import org.apache.commons.csv.writer.CSVWriter;
import org.apache.mahout.cf.taste.common.TasteException;
import org.apache.mahout.cf.taste.eval.RecommenderBuilder;
import org.apache.mahout.cf.taste.impl.model.file.FileDataModel;
import org.apache.mahout.cf.taste.impl.neighborhood.NearestNUserNeighborhood;
import org.apache.mahout.cf.taste.impl.neighborhood.ThresholdUserNeighborhood;
import org.apache.mahout.cf.taste.impl.recommender.GenericItemBasedRecommender;
import org.apache.mahout.cf.taste.impl.recommender.GenericUserBasedRecommender;
import org.apache.mahout.cf.taste.impl.similarity.EuclideanDistanceSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.GenericUserSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.PearsonCorrelationSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.LogLikelihoodSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.SpearmanCorrelationSimilarity;
import org.apache.mahout.cf.taste.impl.similarity.TanimotoCoefficientSimilarity;
import org.apache.mahout.cf.taste.model.DataModel;
import org.apache.mahout.cf.taste.neighborhood.UserNeighborhood;
import org.apache.mahout.cf.taste.recommender.RecommendedItem;
import org.apache.mahout.cf.taste.recommender.Recommender;
import org.apache.mahout.cf.taste.recommender.UserBasedRecommender;
import org.apache.mahout.cf.taste.similarity.ItemSimilarity;
import org.apache.mahout.cf.taste.similarity.UserSimilarity;
/////////////////////////////////////////////////////////////////////
import org.apache.mahout.cf.taste.eval.RecommenderBuilder;
import org.apache.mahout.cf.taste.eval.RecommenderEvaluator;
import org.apache.mahout.cf.taste.impl.eval.AverageAbsoluteDifferenceRecommenderEvaluator;
import org.apache.mahout.cf.taste.impl.eval.RMSRecommenderEvaluator;

public class main {
    public static void main( String[] args ) throws Exception {

        long t= System.currentTimeMillis();
        long end = t+150000000;
        while(System.currentTimeMillis() < end) {

        //get user ID from temp(currently logged in user)
        Connection myConn = getConnection();
        Statement myStmt = myConn.createStatement();
        ResultSet getUserQuery = myStmt.executeQuery("Select * from Temp");
        long user = 0;
        while (getUserQuery.next()) {
            user = getUserQuery.getInt("custID");
        }

        //check Wether rating Exist or not
        ResultSet checkRating = myStmt.executeQuery("SELECT COUNT(*) as noRating from ratings WHERE custID = "+user);
        int existRating = 0;
        while (checkRating.next()) {
            existRating = checkRating.getInt("noRating");
        }
        if (user > 1) {
            if (existRating > 0) {

                //get user ratings from database
                String query1 = "SELECT * FROM ratings WHERE custID = " + user;
                List<String> selectedUser = new ArrayList<String>();
                ResultSet getRatingsQuery = myStmt.executeQuery(query1);
                while (getRatingsQuery.next()) {
                    String getUser = getRatingsQuery.getString("custID") + ",";
                    String getItem = getRatingsQuery.getString("ISBN") + ",";
                    String getRating = getRatingsQuery.getString("rating");
                    String finalAsd = getUser + getItem + getRating;
                    selectedUser.add(finalAsd);
                }

                BufferedReader in = new BufferedReader(new FileReader("data/dataset.csv"));
                String str;

                //get ratings from actual dataset
                List<String> lists = new ArrayList<String>();
                while ((str = in.readLine()) != null) {
                    lists.add(str);
                }

                //Merge actual dataset with user ratings
                for (int xe = 0; xe < selectedUser.size(); xe++) {
                    lists.add(selectedUser.get(xe));
                }

                //insert into temp csv for the User-User Collaborative Filtering
                FileWriter writer1 = new FileWriter("data/temp.csv");
                String collect = lists.stream().collect(Collectors.joining(" "));
                collect = collect.replaceAll(" ", "\n");
                writer1.write(collect);
                writer1.close();

                //System.out.println(lists.size());

                for (int q = 0; q < lists.size(); q++) {
                    //.out.println(lists.get(q));
                }


                //Delete the existing recommended item to replace with a new one
                String delQueries = "DELETE FROM userCF_Recommender where custID ='" + user + "';";
                myStmt.executeUpdate(delQueries);


                //Collaborative Filtering Part (User-user) Recommender Part :
                //Take the temp.csv that includes the requested user and the dataset, as data model for the recommender
                DataModel modelUsers = new FileDataModel(new File("data/temp.csv"));
                //create a user similarity with Loglikehood Similairty algorithm that takes the data model
                UserSimilarity similarityUsers = new LogLikelihoodSimilarity(modelUsers);
                //get the user neighborhood using threshold User Neighborrhood that takes user similairty
                UserNeighborhood neighborhoodUsers = new ThresholdUserNeighborhood(15, similarityUsers, modelUsers);
                UserBasedRecommender recommendUserBased = new GenericUserBasedRecommender(modelUsers, neighborhoodUsers, similarityUsers);


                List<RecommendedItem> recommendations = recommendUserBased.recommend(user, 10);

                //loglikelihood item-based similarities
                ItemSimilarity sim = new LogLikelihoodSimilarity(modelUsers);
                GenericItemBasedRecommender ne = new GenericItemBasedRecommender(modelUsers, sim);
                List<RecommendedItem> recommendations2 = ne.recommend(user, 10);


                String query2;
                for (RecommendedItem itemRecommendation : recommendations2) {
                    //System.out.println("Item " + z + " :" + itemRecommendation.getItemID() + ", value = " + itemRecommendation.getValue());
                    query2 = "INSERT INTO userCF_Recommender (custID,ISBN) VALUES " +
                            "('" + user + "','" + itemRecommendation.getItemID() + "');";
                    myStmt.executeUpdate(query2);
                }

                System.out.println("User-based CBF successfuly processed for user " + user);
            }else{
                System.out.println("No Ratings Have been Made from user "+user);
            }

            ResultSet checkRatingitem = myStmt.executeQuery("SELECT COUNT(*) AS noPurchaseRating FROM ratings WHERE ISBN IN " +
                    "(SELECT ISBN FROM ordereditem WHERE custID = '" + user +
                    "') AND custID = '" + user + "'");
            int existRatingitem = 0;
            while (checkRatingitem.next()) {
                existRatingitem = checkRatingitem.getInt("noPurchaseRating");
            }



            if (existRatingitem > 0) {
                String query3 = "SELECT * FROM ratings WHERE ISBN IN (SELECT ISBN FROM ordereditem WHERE custID = '" + user +
                        "') AND custID = '" + user + "'";
                List<String> selectedUserItemBased = new ArrayList<String>();
                String getUserItemBased;
                String getItemItemBased;
                String getRatingItemBased;
                String finalItemBased;
                ResultSet getRatingsItemBased = myStmt.executeQuery(query3);
                while (getRatingsItemBased.next()) {
                    getUserItemBased = getRatingsItemBased.getString("custID") + ",";
                    getItemItemBased = getRatingsItemBased.getString("ISBN") + ",";
                    getRatingItemBased = getRatingsItemBased.getString("rating");
                    finalItemBased = getUserItemBased + getItemItemBased + getRatingItemBased;
                    selectedUserItemBased.add(finalItemBased);
                }

                BufferedReader in = new BufferedReader(new FileReader("data/dataset.csv"));
                String str;


                List<String> lists = new ArrayList<String>();
                while ((str = in.readLine()) != null) {
                    lists.add(str);
                }


                for (int xe = 0; xe < selectedUserItemBased.size(); xe++) {
                    lists.add(selectedUserItemBased.get(xe));
                }


                //insert into temp csv for the User-User Collaborative Filtering
                FileWriter writer1 = new FileWriter("data/temp.csv");
                String collect = lists.stream().collect(Collectors.joining(" "));
                collect = collect.replaceAll(" ", "\n");
                writer1.write(collect);
                writer1.close();


                //euclidean item-item
                DataModel model = new FileDataModel(new File("data/temp.csv"));
                ItemSimilarity itemSimilarity = new EuclideanDistanceSimilarity(model);
                Recommender itemRecommender = new GenericItemBasedRecommender(model, itemSimilarity);
                List<RecommendedItem> itemRecommendations = itemRecommender.recommend(user, 10);

                String delQueries = "DELETE FROM itemCF_Recommender where custID ='" + user + "';";
                myStmt.executeUpdate(delQueries);

                int y = 1;
                for (RecommendedItem itemRecommendation : itemRecommendations) {
                    //System.out.println("Item " + y + " :" + itemRecommendation.getItemID()); //+ ", value = " +itemRecommendation.getValue());
                    String query6 = "INSERT INTO itemCF_Recommender (custID,ISBN) VALUES " +
                            "('" + user + "','" + itemRecommendation.getItemID() + "');";
                    myStmt.executeUpdate(query6);
                }
                System.out.println("Item-based CBF successfuly processed for user : " + user);
            }else{
                System.out.println("No purchase and Ratings have been made by user "+ user);
            }
        }else{
            System.out.println("No user to be Recommended");
        }


        /*
        //RecommenderEvaluator evaluator = new AverageAbsoluteDifferenceRecommenderEvaluator();
        RecommenderEvaluator evaluator = new RMSRecommenderEvaluator();
        RecommenderBuilder builder1 = new userBasedEvaluatorPearson();
        RecommenderBuilder builder2 = new userBasedEvaluatorLogLikelihood();
        RecommenderBuilder builder3 = new userBasedEvaluatorTanimoto();
        RecommenderBuilder builder4 = new userBasedEvaluatorEuclidean();
        RecommenderBuilder builder5 = new userBasedEvaluatorSpearman();

        double userEvaluation1 = evaluator.evaluate(builder1, null, model, 0.7, 1.0);
        double userEvaluation2 = evaluator.evaluate(builder2, null, model, 0.7, 1.0);
        double userEvaluation3 = evaluator.evaluate(builder3, null, model, 0.7, 1.0);
        double userEvaluation4 = evaluator.evaluate(builder4, null, model, 0.7, 1.0);
        double userEvaluation5 = evaluator.evaluate(builder4, null, model, 0.7, 1.0);

        System.out.println("_________________________________________________");
        System.out.println("User-user Pearson Correlation Similarity RMSE : " + userEvaluation1);
        System.out.println("User-user Loglikelihood Similarity RMSE : " + userEvaluation2);
        System.out.println("User-user Tanimoto Coefficient Similarity RMSE : " + userEvaluation3);
        System.out.println("User-user Euclidean Distance Similarity RMSE : " + userEvaluation4);
        System.out.println("User-user Spearman Correlation Similarity RMSE : " + userEvaluation5);

        System.out.println("_________________________________________________");

        RecommenderBuilder builders1 = new itemBasedEvaluatorEuclidean();
        RecommenderBuilder builders2 = new itemBasedEvaluatorPearson();
        RecommenderBuilder builders3 = new itemBasedEvaluatorTanimoto();
        RecommenderBuilder builders4 = new itemBasedEvaluatorLogLikelihood();

        double itemEvaluation1 = evaluator.evaluate(builders1, null, model, 0.7, 1.0);
        double itemEvaluation2 = evaluator.evaluate(builders2, null, model, 0.7, 1.0);
        double itemEvaluation3 = evaluator.evaluate(builders3, null, model, 0.7, 1.0);
        double itemEvaluation4 = evaluator.evaluate(builders4, null, model, 0.7, 1.0);

        System.out.println("Item-item Euclidean Distance Similarity RMSE :" + itemEvaluation1);
        System.out.println("Item-item Pearson Corelation Similarity RMSE :" + itemEvaluation2);
        System.out.println("Item-item Tanimoto Similarity RMSE :" + itemEvaluation3);
        System.out.println("Item-item Loglikelihood Similarity RMSE :" + itemEvaluation4);
        */

        Thread.sleep(2000);
        }
    }


    public static Connection getConnection() throws Exception{
        try{
            String driver = "com.mysql.jdbc.Driver";
            String url = "jdbc:mysql://localhost:3306/Adaptive_Rec_System";
            String username = "root";
            String Password = "mysql";
            Class.forName(driver);

            Connection conn = DriverManager.getConnection(url,username,Password);
            return conn;
        }catch(Exception e){
            System.out.println(e);
        }
        return null;
    }
}




//for evaluation Purposes
/*
class userBasedEvaluatorPearson implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        UserSimilarity similarity = new PearsonCorrelationSimilarity(dataModel);
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,similarity,dataModel);
        //UserNeighborhood neighborhood = new NearestNUserNeighborhood(100, similarity, dataModel);
        return new GenericUserBasedRecommender(dataModel,neighborhood,similarity);
    }
}


class userBasedEvaluatorLogLikelihood implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        UserSimilarity similarity = new LogLikelihoodSimilarity(dataModel);
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,similarity,dataModel);
        //UserNeighborhood neighborhood = new NearestNUserNeighborhood(100, similarity, dataModel);
        return new GenericUserBasedRecommender(dataModel,neighborhood,similarity);
    }
}



class userBasedEvaluatorTanimoto implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        UserSimilarity similarity = new TanimotoCoefficientSimilarity(dataModel);
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,similarity,dataModel);
        //UserNeighborhood neighborhood = new NearestNUserNeighborhood(100, similarity, dataModel);
        return new GenericUserBasedRecommender(dataModel,neighborhood,similarity);
    }
}

class userBasedEvaluatorEuclidean implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        UserSimilarity similarity = new EuclideanDistanceSimilarity(dataModel);
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,similarity,dataModel);
        //UserNeighborhood neighborhood = new NearestNUserNeighborhood(100, similarity, dataModel);
        return new GenericUserBasedRecommender(dataModel,neighborhood,similarity);
    }
}

class userBasedEvaluatorSpearman implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        UserSimilarity similarity = new SpearmanCorrelationSimilarity(dataModel);
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,similarity,dataModel);
        //UserNeighborhood neighborhood = new NearestNUserNeighborhood(100, similarity, dataModel);
        return new GenericUserBasedRecommender(dataModel,neighborhood,similarity);
    }
}



class itemBasedEvaluatorEuclidean implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        ItemSimilarity itemSimilarity = new EuclideanDistanceSimilarity (dataModel);
        Recommender itemRecommender = new GenericItemBasedRecommender(dataModel,itemSimilarity);
        return new GenericItemBasedRecommender(dataModel,itemSimilarity);
    }
}


class itemBasedEvaluatorPearson implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        ItemSimilarity itemSimilarity = new PearsonCorrelationSimilarity (dataModel);
        Recommender itemRecommender = new GenericItemBasedRecommender(dataModel,itemSimilarity);
        return new GenericItemBasedRecommender(dataModel,itemSimilarity);
    }
}


class itemBasedEvaluatorTanimoto implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        ItemSimilarity itemSimilarity = new TanimotoCoefficientSimilarity (dataModel);
        Recommender itemRecommender = new GenericItemBasedRecommender(dataModel,itemSimilarity);
        return new GenericItemBasedRecommender(dataModel,itemSimilarity);
    }
}

class itemBasedEvaluatorLogLikelihood implements RecommenderBuilder{

    public Recommender buildRecommender(DataModel dataModel) throws TasteException{
        ItemSimilarity itemSimilarity = new LogLikelihoodSimilarity (dataModel);
        Recommender itemRecommender = new GenericItemBasedRecommender(dataModel,itemSimilarity);
        return new GenericItemBasedRecommender(dataModel,itemSimilarity);
    }
}
*/


