import java.util.List;

public class TFIDFCalculator {

        public double tf(List<String> document, String terms) {
            double result = 0;
            for (String word : document) {
                if (terms.equalsIgnoreCase(word))
                    result++;
            }
            return result / document.size();
        }


        public double idf(List<List<String>> documents, String terms) {
            double x = 0;
            for (List<String> document : documents) {
                for (String word : document) {
                    if (terms.equalsIgnoreCase(word)) {
                        x++;
                        break;
                    }
                }
            }
            return Math.log(documents.size() / x);
        }

        public double tfIdf(List<String> document, List<List<String>> documents, String terms) {
            return tf(document, terms) * idf(documents, terms);

        }

}
