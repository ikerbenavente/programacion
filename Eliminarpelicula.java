package Parte2;

import java.sql.*;
import java.util.Scanner;

public class Eliminarpelicula {
    public static void eliminar(Scanner sc) {
        System.out.print("Ingrese el código de la película a eliminar: ");
        String codigo = sc.nextLine();
//Consulta sql para eliminar la pelicula
        String comprobar = "SELECT * FROM peliculas WHERE codigo_pelicula = ?";
        String eliminar = "DELETE FROM peliculas WHERE codigo_pelicula = ?";

        try (Connection conn = Conexion.conectar();
             PreparedStatement check = conn.prepareStatement(comprobar);
             PreparedStatement delete = conn.prepareStatement(eliminar)) {

            check.setString(1, codigo);
            ResultSet rs = check.executeQuery();

            if (!rs.next()) {
                System.out.println("La película no existe.");
                return;
            }

            delete.setString(1, codigo);
            int filas = delete.executeUpdate();

            if (filas > 0) {
                System.out.println("Película eliminada correctamente.");
            }
//Muestra un error si no esta en la base de datos
        } catch (SQLException e) {
            System.out.println("Error al eliminar película: " + e.getMessage());
        }
    }
}