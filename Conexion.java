package Parte2;
import java.sql.*;

public class Conexion { //Conexioncon la base de datos 
	  private static final String URL = "jdbc:mysql://localhost:3306/cine_IkerBenavente";
	    private static final String USUARIO = "root";
	    private static final String CONTRASEÑA = "curso";

	    public static Connection conectar() throws SQLException {
	        return DriverManager.getConnection(URL, USUARIO, CONTRASEÑA);
	    }
	}
