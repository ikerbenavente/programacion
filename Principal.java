package HITO2;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;

public class Principal {
    public static void main(String[] args) {
        HashMap<String, String> animalesRegistrados = new HashMap<>();
        ArrayList<String> listaAdopciones = new ArrayList<>();
        Scanner scanner = new Scanner(System.in);

        int opcionSeleccionada = 0;

        do {// bucle para mostar el menu
            System.out.println("\n=== MENÚ PROTECTORA DE ANIMALES ===");
            System.out.println("1 – Registrar un animal");
            System.out.println("2 – Listar animales registrados");
            System.out.println("3 – Buscar un animal por chip");
            System.out.println("4 – Realizar una adopción");
            System.out.println("5 – Eliminar un animal");
            System.out.println("6 – Ver estadísticas de gatos");
            System.out.println("7 – Salir");
            System.out.print("Seleccione una opción: ");

            try { //Segun la opcion que selecionemos hace una accion u otra 
                opcionSeleccionada = Integer.parseInt(scanner.nextLine());

                switch (opcionSeleccionada) {
                    case 1:
                    	registrarAnimal(animalesRegistrados, scanner);
                    case 2:
						listarAnimales(animalesRegistrados);
                    case 3:
						buscarAnimalPorChip(animalesRegistrados, scanner);
                    case 4:
						realizarAdopcion(animalesRegistrados, listaAdopciones, scanner);
                    case 5:
						eliminarAnimal(animalesRegistrados, listaAdopciones, scanner);
                    case 6:
						mostrarEstadisticasGatos(animalesRegistrados);
                    case 7:
						System.out.println("Saliendo del programa...");
                    default:
						System.out.println("Opción no válida.");
                }
            } catch (NumberFormatException e) {
                System.out.println("Por favor, ingresa un número válido.");
            }

        } while (opcionSeleccionada != 7);
    }
//Funcion para registrar animales 
    public static void registrarAnimal(HashMap<String, String> animales, Scanner scanner) {
        System.out.print("¿Es un perro o un gato? ");
        String tipoAnimal = scanner.nextLine().toLowerCase();

        System.out.print("Número de chip: ");
        String chipAnimal = scanner.nextLine();

        if (animales.containsKey(chipAnimal)) {
            System.out.println("Ya existe un animal con este chip.");//Si el chip ya a sido registrado se muenstra el mensaje
            return;
        }
//Te pide todos klos datos del animal para registrarlo
        System.out.print("Nombre del animal: ");
        String nombreAnimal = scanner.nextLine();
        System.out.print("Edad: ");
        String edadAnimal = scanner.nextLine();
        System.out.print("Raza: ");
        String razaAnimal = scanner.nextLine();

        String animalInfo;
// Con el condicional si es un pero hace unas acciones diferentes que si es gato
        if (tipoAnimal.equals("perro")) {
            System.out.print("Tamaño (Pequeño/Mediano/Grande): ");
            String tamanoPerro = scanner.nextLine();
            animalInfo = "Perro | Chip: " + chipAnimal + ", Nombre: " + nombreAnimal + ", Edad: " + edadAnimal + ", Raza: " + razaAnimal + ", Tamaño: " + tamanoPerro + ", Adoptado: No";
        } else if (tipoAnimal.equals("gato")) {
        	System.out.print("¿Test de leucemia positivo? (true/false): ");
        	String input = scanner.nextLine();
        	boolean leucemia;
        	if (input.toLowerCase().contains("true")) {
        	    leucemia = true;
        	} else {
        	    leucemia = false;
        	}

            animalInfo = "Gato | Chip: " + chipAnimal + ", Nombre: " + nombreAnimal + ", Edad: " + edadAnimal + ", Raza: " + razaAnimal + ", Leucemia: " + (leucemia ? "Sí" : "No") + ", Adoptado: No";
        } else {
            System.out.println("Tipo de animal no válido.");
            return;
        }

        animales.put(chipAnimal, animalInfo);
        System.out.println("Animal registrado correctamente.");
    }
// Con esta funcion se muestran los animales registrados 
    public static void listarAnimales(HashMap<String, String> animales) {
        if (animales.size() == 0) {
            System.out.println("No hay animales registrados.");
            return;
        }
        for (String info : animales.values()) {
            System.out.println(info);
        }
    }
 //Introduciendo el chip se busca el animal
    public static void buscarAnimalPorChip(HashMap<String, String> animales, Scanner scanner) {
        System.out.print("Introduce el número de chip del animal: ");
        String chipAnimal = scanner.nextLine();
        String animal = animales.get(chipAnimal);
        if (animal != null) {
            System.out.println(animal);
        } else {
            System.out.println("Animal no encontrado.");
        }
    }
    //Para hacer la opdopcion introduce los datos de la porsona que adopta y los registra

    public static void realizarAdopcion(HashMap<String, String> animales, ArrayList<String> adopciones, Scanner scanner) {
        System.out.print("Introduce el chip del animal para adopción: ");
        String chipAnimal = scanner.nextLine();
        String animal = animales.get(chipAnimal);
        if (animal == null) {
            System.out.println("Este animal no está disponible para adopción.");
            return;
        }

        animal = animal.replace("Adoptado: No", "Adoptado: Sí");
        animales.put(chipAnimal, animal);
        adopciones.add(animal);
        System.out.println("Adopción registrada correctamente.");
    }
//Elimina animales, te pide los datos y lo elimina
    public static void eliminarAnimal(HashMap<String, String> animales, ArrayList<String> adopciones, Scanner scanner) {
        System.out.print("Introduce el chip del animal a eliminar: ");
        String chipAnimal = scanner.nextLine();
        String animal = animales.remove(chipAnimal);
        if (animal != null) {
            adopciones.remove(animal);
            System.out.println("Animal eliminado del sistema.");
        } else {
            System.out.println("No existe un animal con ese chip.");
        }
    }

    public static void mostrarEstadisticasGatos(HashMap<String, String> animales) {
        int totalGatos = 0;
        int gatosConLeucemia = 0;
        for (String info : animales.values()) {
            if (info.contains("Raza: Gato")) {
                totalGatos++;
                if (info.contains("Leucemia: Sí")) {
                    gatosConLeucemia++;
                }
            }
        }
        System.out.println("Total de gatos registrados: " + totalGatos);
        System.out.println("Gatos con leucemia: " + gatosConLeucemia);
    }
}

