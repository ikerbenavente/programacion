package HITO2;

public class Adopcion {
    String animal;
    String nombreAdoptante;
    String dniAdoptante;

    // Constructor
    public Adopcion(String animal, String nombreAdoptante, String dniAdoptante) {
        this.animal = animal;
        this.nombreAdoptante = nombreAdoptante;
        this.dniAdoptante = dniAdoptante;
    }

    // Métodos getters
    public String getAnimal() {
        return animal;
    }

    public String getNombreAdoptante() {
        return nombreAdoptante;
    }

    public String getDniAdoptante() {
        return dniAdoptante;
    }
}

