package HITO2;

public class Gato extends Animal {
	boolean test_leucemia;
	//construct
	public Gato(String numero_chip, String nombre, int edad, String raza, boolean adoptado,boolean test_leucemia) {
		super(numero_chip, nombre, edad, raza, adoptado);
		this.test_leucemia=test_leucemia;
	}
	//Funcion para mostrar los datos de los gatos
	public void mostrar() {
		System.out.println(" Numero de chip: "+ chipAnimal +" Nombre:" +nombre+ " Edad: "+edad + " Raza: "+raza);
		System.out.println(" Adoptado:"+ (adoptado? "Si":"No")+ " Test de leucemia:"+ (test_leucemia? "SI":"No"));
	}
	 // Función para verificar si el gato tiene leucemia
    public boolean tieneLeucemia() {
        return test_leucemia;
    }
}
