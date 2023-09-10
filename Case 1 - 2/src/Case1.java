import java.util.ArrayList;
import java.util.List;

class Fruit {
    int fruitId;
    String fruitName;
    String fruitType;
    int stock;

    public Fruit(int fruitId, String fruitName, String fruitType, int stock) {
        this.fruitId = fruitId;
        this.fruitName = fruitName;
        this.fruitType = fruitType;
        this.stock = stock;
    }
}

public class Case1 {
    public static void main(String[] args) {
        List<Fruit> fruits = new ArrayList<>();
        fruits.add(new Fruit(1, "Apel", "IMPORT", 10));
        fruits.add(new Fruit(2, "Kurma", "IMPORT", 20));
        fruits.add(new Fruit(3, "apel", "IMPORT", 50));
        fruits.add(new Fruit(4, "Manggis", "LOCAL", 100));
        fruits.add(new Fruit(5, "Jeruk Bali", "LOCAL", 10));
        fruits.add(new Fruit(5, "KURMA", "IMPORT", 20));
        fruits.add(new Fruit(5, "Salak", "LOCAL", 150));

        // Jawaban soal 1
        System.out.println("Soal 1: Buah apa saja yang dimiliki Andi?");
        for (Fruit fruit : fruits) {
            System.out.println(fruit.fruitName);
        }

        // Jawaban soal 2
        System.out.println("\nSoal 2: Berapa jumlah wadah yang dibutuhkan dan ada buah apa saja di masing-masing wadah?");
        int localContainerCount = 0;
        int importContainerCount = 0;
        List<Fruit> localContainer = new ArrayList<>();
        List<Fruit> importContainer = new ArrayList<>();

        for (Fruit fruit : fruits) {
            if (fruit.fruitType.equalsIgnoreCase("LOCAL")) {
                if (!localContainer.contains(fruit)) {
                    localContainerCount++;
                    localContainer.add(fruit);
                }
            } else {
                if (!importContainer.contains(fruit)) {
                    importContainerCount++;
                    importContainer.add(fruit);
                }
            }
        }

        System.out.println("Jumlah wadah buah LOCAL: " + localContainerCount);
        System.out.println("Buah-buahan di wadah buah LOCAL:");
        for (Fruit fruit : localContainer) {
            System.out.println(fruit.fruitName);
        }

        System.out.println("\nJumlah wadah buah IMPORT: " + importContainerCount);
        System.out.println("Buah-buahan di wadah buah IMPORT:");
        for (Fruit fruit : importContainer) {
            System.out.println(fruit.fruitName);
        }

        // Jawaban soal 3
        System.out.println("\nSoal 3: Berapa total stock buah yang ada di masing-masing wadah?");
        int totalLocalStock = 0;
        int totalImportStock = 0;

        for (Fruit fruit : fruits) {
            if (fruit.fruitType.equalsIgnoreCase("LOCAL")) {
                totalLocalStock += fruit.stock;
            } else {
                totalImportStock += fruit.stock;
            }
        }

        System.out.println("Total stock buah LOCAL: " + totalLocalStock);
        System.out.println("Total stock buah IMPORT: " + totalImportStock);
    }
}
