
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.*;


public class Main {

    public static void main(String[] args) throws Exception {
        long t = System.currentTimeMillis();
        long end = t + 1500000000;
        while (System.currentTimeMillis() < end) {

            //get a particular user or current user
            Connection myConn = getConnection();
            Statement myStmt = myConn.createStatement();
            ResultSet myRs = myStmt.executeQuery("Select * from Temp");
            long user = 0;
            while (myRs.next()) {
                user = myRs.getInt("custID");
            }

            //get a particular user that associated from their cart
            String query1 = "SELECT * from Cart WHERE custId = " + user;
            List<String> cartItem = new ArrayList<String>();
            ResultSet itemRs = myStmt.executeQuery(query1);
            while (itemRs.next()) {
                cartItem.add(itemRs.getString("ISBN"));
            }
            if (user>1) {
                if (cartItem != null) {
                    //get item tags from user cart items
                    List<String> current_Author = new ArrayList<String>();
                    List<String> current_Year = new ArrayList<String>();
                    List<String> current_Publisher = new ArrayList<String>();
                    List<String> current_Price = new ArrayList<String>();
                    for (int i = 0; i < cartItem.size(); i++) {
                        String query2 = "SELECT * from items WHERE ISBN = " + cartItem.get(i);
                        ResultSet itemDetails = myStmt.executeQuery(query2);
                        while (itemDetails.next()) {
                            current_Author.add(itemDetails.getString("bookAuthor"));
                            current_Year.add(itemDetails.getString("publicationYear"));
                            current_Publisher.add(itemDetails.getString("publisher"));
                            current_Price.add(itemDetails.getString("unitPrice"));
                        }

                    }

                    //get all of the book details
                    List<String> book_ISBN = new ArrayList<String>();
                    List<String> book_Author = new ArrayList<String>();
                    List<String> book_Year = new ArrayList<String>();
                    List<String> book_Publisher = new ArrayList<String>();
                    List<String> book_Price = new ArrayList<String>();
                    ResultSet allBooks = myStmt.executeQuery("Select * from items");
                    while (allBooks.next()) {
                        book_ISBN.add(allBooks.getString("ISBN"));
                        book_Author.add(allBooks.getString("bookAuthor"));
                        book_Year.add(allBooks.getString("publicationYear"));
                        book_Publisher.add(allBooks.getString("publisher"));
                        book_Price.add(allBooks.getString("unitPrice"));
                    }

                    //validation for duplicating books (cart with all books)
                    for (int x = 0; x < cartItem.size(); x++) {
                        for (int y = 0; y < book_ISBN.size(); y++) {
                            String curISBN = "";
                            String defISBN = "";
                            curISBN = cartItem.get(x);
                            defISBN = book_ISBN.get(y);
                            if (curISBN.equals(defISBN)) {
                                book_ISBN.remove(y);
                                book_Author.remove(y);
                                book_Year.remove(y);
                                book_Publisher.remove(y);
                                book_Price.remove(y);
                            }
                        }
                    }

                    //calculate TF-IDF score of books from cart given all of the books
                    List<Double> scoreTFIDF = new ArrayList<Double>();
                    for (int x = 0; x < cartItem.size(); x++) {
                        for (int y = 0; y < book_ISBN.size(); y++) {
                            List<String> doc1 = Arrays.asList(current_Author.get(x), current_Year.get(x)
                                    , current_Publisher.get(x), current_Price.get(x));
                            List<String> doc2 = Arrays.asList(book_Author.get(y), book_Year.get(y),
                                    book_Publisher.get(y), book_Price.get(y));
                            List<List<String>> documents = Arrays.asList(doc1, doc2);
                            double finalTFIDF = 0;
                            for (int i = 0; i < doc1.size(); i++) {
                                TFIDFCalculator calculator = new TFIDFCalculator();
                                double tfidf = calculator.tfIdf(doc1, documents, doc1.get(i));
                                finalTFIDF = finalTFIDF + tfidf;
                            }
                            scoreTFIDF.add(finalTFIDF);
                            String query3 = "INSERT INTO TFIDF_Temp (cartBook,comparisonBook,TFIDF_Score) VALUES ('"
                                    + cartItem.get(x)
                                    + "','" + book_ISBN.get(y)
                                    + "','" + finalTFIDF
                                    + "');";
                            myStmt.executeUpdate(query3);
                            //System.out.println("Cart item : "+cartItem.get(x)+", for item : "+book_ISBN.get(y)+", TFIDF score :"+finalTFIDF);
                        }
                    }

                    //get the lowest TF-IDF score and get a set of recommended products to user
                    List<String> RecommendedProducts = new ArrayList<String>();
                    int totalCartItem = cartItem.size();
                    if (totalCartItem == 1) {
                        for (int y = 0; y < cartItem.size(); y++) {
                            ResultSet Recommended = myStmt.executeQuery("SELECT * from TFIDF_Temp where cartBook = '" +
                                    cartItem.get(y) +
                                    "'ORDER BY TFIDF_score ASC LIMIT 10");
                            while (Recommended.next()) {
                                RecommendedProducts.add(Recommended.getString("comparisonBook"));
                            }
                        }
                    } else if (totalCartItem == 2) {
                        for (int y = 0; y < cartItem.size(); y++) {
                            ResultSet Recommended = myStmt.executeQuery("SELECT * from TFIDF_Temp where cartBook = '" +
                                    cartItem.get(y) +
                                    "'ORDER BY TFIDF_score ASC LIMIT 5");
                            while (Recommended.next()) {
                                RecommendedProducts.add(Recommended.getString("comparisonBook"));
                            }
                        }
                    } else if (totalCartItem == 3) {
                        for (int y = 0; y < cartItem.size(); y++) {
                            ResultSet Recommended = myStmt.executeQuery("SELECT * from TFIDF_Temp where cartBook = '" +
                                    cartItem.get(y) +
                                    "'ORDER BY TFIDF_score ASC LIMIT 3");
                            while (Recommended.next()) {
                                RecommendedProducts.add(Recommended.getString("comparisonBook"));
                            }
                        }
                    } else if (totalCartItem > 4) {
                        for (int y = 0; y < cartItem.size(); y++) {
                            ResultSet Recommended = myStmt.executeQuery("SELECT * from TFIDF_Temp where cartBook = '" +
                                    cartItem.get(y) +
                                    "'ORDER BY TFIDF_score ASC LIMIT 2");
                            while (Recommended.next()) {
                                RecommendedProducts.add(Recommended.getString("comparisonBook"));
                            }
                        }
                    } else if (totalCartItem > 10) {
                        for (int y = 0; y < cartItem.size(); y++) {
                            ResultSet Recommended = myStmt.executeQuery("SELECT * from TFIDF_Temp where cartBook = '" +
                                    cartItem.get(y) +
                                    "'ORDER BY TFIDF_score ASC LIMIT 10");
                            while (Recommended.next()) {
                                RecommendedProducts.add(Recommended.getString("comparisonBook"));
                            }
                        }
                    }
                    //Remove All Element From the Current Temp
                    if(cartItem.size()> 0) {
                        String query4 = "Delete FROM TFIDF_TEMP";
                        myStmt.executeUpdate(query4);

                        //delete the existing recommended products and replace it with a new one
                        String query5 = "Delete FROM contentBF_Recommender WHERE custID = " + user;
                        myStmt.executeUpdate(query5);

                        //Remove Duplicated Products and update Recommended Product query
                        Set<String> removeDuplicates = new HashSet<>();
                        removeDuplicates.addAll(RecommendedProducts);
                        RecommendedProducts.clear();
                        RecommendedProducts.addAll(removeDuplicates);
                        for (int x = 0; x < RecommendedProducts.size(); x++) {
                            String query6 = "INSERT INTO contentBF_Recommender (custID,ISBN) VALUES ('"
                                    + user
                                    + "','" + RecommendedProducts.get(x)
                                    + "');";
                            myStmt.executeUpdate(query6);
                        }
                        System.out.println("Successfully CBF recommended to user : " + user);
                    }
                    else{
                        System.out.println("No item have been added to the cart by user ="+user);
                    }
                }
            }else{
                System.out.println("No user to be recommended");
            }
            Thread.sleep(2000);
        }
    }


    public double tf(List<String> doc, String term) {
        double result = 0;
        for (String word : doc) {
            if (term.equalsIgnoreCase(word))
                result++;
        }
        return result / doc.size();
    }

    public double idf(List<List<String>> docs, String term) {
        double n = 0;
        for (List<String> doc : docs) {
            for (String word : doc) {
                if (term.equalsIgnoreCase(word)) {
                    n++;
                    break;
                }
            }
        }
        return Math.log(docs.size() / n);
    }
    public double tfIdf(List<String> doc, List<List<String>> docs, String term) {
        return tf(doc, term) * idf(docs, term);
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

