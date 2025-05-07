package Parte2;
import java.sql.*;
import java.util.Scanner;

public class Editarpeliculas {
    public static void editar(Scanner sc) {//Pide el codigo de la pelicula
        System.out.print("Código de la película a modificar: ");
        String codigo = sc.nextLine();

        String comprobar = "SELECT * FROM peliculas WHERE codigo_pelicula = ?";// comprueba si existe
        String update = "UPDATE peliculas SET titulo = ?, duracion = ? WHERE codigo_pelicula = ?";//actualiza la pelicula

        try (Connection conn = Conexion.conectar();
             PreparedStatement check = conn.prepareStatement(comprobar);
             PreparedStatement modificar = conn.prepareStatement(update)) {

            check.setString(1, codigo);
            ResultSet rs = check.executeQuery();

            if (!rs.next()) {
                System.out.println("La película no existe.");
                return;
            }// Se introducen los datos de la pelicula

            System.out.print("Nuevo título: ");
            String nuevoTitulo = sc.nextLine();
            System.out.print("Nueva duración (minutos): ");
            int nuevaDuracion = sc.nextInt();
            sc.nextLine(); // limpiar buffer

            modificar.setString(1, nuevoTitulo);
            modificar.setInt(2, nuevaDuracion);
            modificar.setString(3, codigo);

            int filas = modificar.executeUpdate();
            if (filas > 0) {
                System.out.println("Película modificada correctamente.");
            }

        } catch (SQLException e) {
            System.out.println("Error al modificar película: " + e.getMessage());
        }
    }
}