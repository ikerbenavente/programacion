package parte_1;

import java.sql.*;
import java.util.Scanner;

public class AppCine {

 static class ConexionBD { //Creo la conexion con la base de datos en mysql
     private static final String URL = "jdbc:mysql://localhost:3306/cine_IkerBenavente";
     private static final String USUARIO = "root";
     private static final String CONTRASEÑA = "curso"; 

     public static Connection conectar() throws SQLException {
         return DriverManager.getConnection(URL, USUARIO, CONTRASEÑA);
     }
 }
//Clase Pelicula con los atributos definidos
 static class Pelicula {
     String codigo;
     String titulo;
     String director;
     int duracion;
     String genero;
// Constructor para pelicula
     public Pelicula(String codigo, String titulo, String director, int duracion, String genero) {
         this.codigo = codigo;
         this.titulo = titulo;
         this.director = director;
         this.duracion = duracion;
         this.genero = genero;
     }
//Funcion que muestra en la consola las peliculas
     public void mostrar() {
         System.out.println("Código: " + codigo);
         System.out.println("Título: " + titulo);
         System.out.println("Director: " + director);
         System.out.println("Duración: " + duracion + " min");
         System.out.println("Género: " + genero);
         System.out.println("-----------------------------------");
     }
 }
//Funcion que muestra un menu interactivo 
 public static void mostrarMenu() {
     System.out.println("\n----- MENÚ CINE -----");
     System.out.println("1 - Ver películas");
     System.out.println("2 - Salir");
     System.out.print("Seleccione una opción: ");
 }
//Funcion que realiza la consulta para mostrar las peliculas y su informacion
 public static void verPeliculas() {
     String sql = "SELECT p.codigo_pelicula, p.titulo, p.director, p.duracion, g.nombre_genero " +
                  "FROM peliculas p JOIN generos g ON p.id_genero = g.id_genero";

     try (Connection conn = ConexionBD.conectar();
          Statement stmt = conn.createStatement();
          ResultSet rs = stmt.executeQuery(sql)) {

         System.out.println("\n--- Lista de Películas ---\n");

         while (rs.next()) {
             Pelicula peli = new Pelicula(
                 rs.getString("codigo_pelicula"),
                 rs.getString("titulo"),
                 rs.getString("director"),
                 rs.getInt("duracion"),
                 rs.getString("nombre_genero")
             );
             peli.mostrar();// Muestra la info en la consola
         }

     } catch (SQLException e) {
         System.out.println("Error al consultar las películas: " + e.getMessage());
     }
 }

 public static void main(String[] args) { //Mediante el  main controla todo el programa
     try (Scanner sc = new Scanner(System.in)) {
		int opcion;

		 do { // Mediante un bucle se muestra el menu 
		     mostrarMenu();
		     while (!sc.hasNextInt()) {
		         System.out.print("Por favor, introduzca una opción válida: ");
		         sc.next();
		     }
		     opcion = sc.nextInt();

		     switch (opcion) {// Mediate un switch he hecho que segun la opcion del usuario haga una opcion u otra, en este caso salir o mostrar las peliculas
		         case 1:
		             verPeliculas();
		             break;
		         case 2:
		             System.out.println("¡Hasta luego!");
		             break;
		         default:
		             System.out.println("Opción no válida.");
		     }

		 } while (opcion != 2); // Repite el bucle hasta que la opcion se a 2 
	}
 }
}
