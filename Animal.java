package HITO2;

public abstract class Animal {
	//Defino los atributos de la clase
	String chipAnimal;
	String nombre;
	int edad;
	String raza;
	boolean adoptado;// solo puede ser true o false (si o no)
	//Hago un construc para evitar errores
	public Animal(String numero_chip,String nombre, int edad, String raza, boolean adoptado) {
		this.chipAnimal= numero_chip;
		this.nombre=nombre;
		this.edad=edad;
		this.raza=raza;
		this.adoptado=adoptado;		
	}
	//Hago la funcion para obtener el numero de chip
	public String getnumero_chip() {
	    return chipAnimal;
	}

	// Función para verificar si el animal está adoptado
	    public boolean estaAdoptado() {
	        return adoptado;
	    }

	    // Función para marcar al animal como adoptado
	    public void marcarComoAdoptado() {
	        this.adoptado = true;
	    }
	    
	 //Funcion para mostrar los datos
	 public void mostrar() {
	 }
}	