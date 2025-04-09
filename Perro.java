package HITO2;

public class Perro extends Animal{
	String tamaño;
	//costruct
	public Perro(String numero_chip, String nombre, int edad, String raza, boolean adoptado, String tamaño) {
		super(numero_chip, nombre, edad, raza, adoptado);
		this.tamaño=tamaño;
	}
	//Funcion para mostrar los datos de los perros 
	public void mostrar() {
		System.out.println("Numero de chip: "+ chipAnimal +" Nombre:" +nombre+ " Edad: "+edad + " Raza: "+raza);
		System.out.println("Adoptado: "+ (adoptado? "Si":"No")+ " Tamaño: "+ tamaño);
	}
}
