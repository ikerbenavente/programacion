package Parte2;

import java.util.Scanner;

public class Principal {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int opcion = 0;

        do {//Menu para seleccionar las acciones 
            System.out.println("\n----- MENÚ CINE -----");
            System.out.println("1 - Ver películas");
            System.out.println("2 - Añadir película");
            System.out.println("3 - Eliminar película");
            System.out.println("4 - Modificar película");
            System.out.println("5 - Salir");
            System.out.print("Seleccione una opción: ");

            if (sc.hasNextInt()) {
                opcion = sc.nextInt();
                //Selector de accion, segun el numero que introduzca se hace una accion
                switch (opcion) {
                    case 1 -> Mostrarpelicula.mostrar();
                    case 2 -> Añadirpelicula.anadir(sc);
                    case 3 -> Eliminarpelicula.eliminar(sc);
                    case 4 -> Editarpeliculas.editar(sc);
                    case 5 -> System.out.println("¡Hasta luego!");
                    default -> System.out.println("Opción no válida.");
                }
            } else {//Error si se introduce un numero invalido
                System.out.println("Por favor, introduzca un número válido.");
            }

        } while (opcion != 5);//Bucle para que si la opcion es diferente a 5 vuelva a salir el menu

        sc.close();
    }
}