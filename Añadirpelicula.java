package Parte2;
import java.sql.*;
import java.util.Scanner;

public class Añadirpelicula {
    public static void anadir(Scanner sc) {// Al añadir una pelicula nos pide que introduzcamos los datos de esta
        System.out.print("Código de la película: ");
        String codigo = sc.nextLine();

        System.out.print("Título: ");
        String titulo = sc.nextLine();

        System.out.print("Director: ");
        String director = sc.nextLine();

        System.out.print("Duración (en minutos): ");
        int duracion = sc.nextInt();

        System.out.print("Género (ACC, COM, ROM): ");
        String idGenero = sc.nextLine();
//comprueba si exisite
        String consultaExiste = "SELECT codigo_pelicula FROM peliculas WHERE codigo_pelicula = ?";
        // Añade la pelicula a la base de datos
        String insertarSQL = "INSERT INTO peliculas (codigo_pelicula, titulo, director, duracion, id_genero) VALUES (?, ?, ?, ?, ?)";

        try (Connection conn = Conexion.conectar();
             PreparedStatement comprobar = conn.prepareStatement(consultaExiste);
             PreparedStatement insertar = conn.prepareStatement(insertarSQL)) {

            comprobar.setString(1, codigo);
            ResultSet rs = comprobar.executeQuery();

            if (rs.next()) {
                System.out.println("Ya existe una película con ese código.");
                return;
            }

            insertar.setString(1, codigo);
            insertar.setString(2, titulo);
            insertar.setString(3, director);
            insertar.setInt(4, duracion);
            insertar.setString(5, idGenero);

            int filas = insertar.executeUpdate();
            if (filas > 0) {
                System.out.println("Película añadida correctamente.");
            }

        } catch (SQLException e) {
            System.out.println("Error al añadir película: " + e.getMessage());
        }
    }
}