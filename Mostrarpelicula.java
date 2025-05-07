package Parte2;
import java.sql.*;

public class Mostrarpelicula {
    public static void mostrar() {
    	//Consulta sql
        String sql = "SELECT p.codigo_pelicula, p.titulo, p.director, p.duracion, g.nombre_genero " +
                     "FROM peliculas p JOIN generos g ON p.id_genero = g.id_genero";

        try (Connection conexion = Conexion.conectar();
             Statement stmt = conexion.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            System.out.println("\n--- Lista de Películas ---\n");//Formato en el que se muestran las peliculas 
            while (rs.next()) {
                System.out.println("Código: " + rs.getString("codigo_pelicula"));
                System.out.println("Título: " + rs.getString("titulo"));
                System.out.println("Director: " + rs.getString("director"));
                System.out.println("Duración: " + rs.getInt("duracion") + " min");
                System.out.println("Género: " + rs.getString("nombre_genero"));
                System.out.println("-----------------------------------");
            }

        } catch (SQLException e) {
            System.out.println("Error al mostrar las películas: " + e.getMessage());
        }
    }
}