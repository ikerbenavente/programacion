#Defino las funciones del menu, calculo de areas y perimetros y del dibujo de las figuras
def menu():
    print("Selecciona una opcion: ")
    print("1-Cuadrado")
    print("2-Rectangulo")
    print("3-salir")

def area_cuadrado(lado):
     return lado * lado

def dibujo_cuadrado(lado):
    for i in range(lado):
        print("*" * lado)
def perimetro_cuadrado(lado):
    return 4*lado

def area_rectangulo(base, altura):
   return (base*altura)/2

def perimetro_rectangulo(base, altura):
   return 2*base + 2*altura

def dibujo_rectangulo(base, altura):
    for i in range(altura):
        print("*" * base)
#Mediante el bucle hago que despues de calculo el menu vuelva a paracer hasta el el usiario quiera salir
while True:
    menu()
    opcion = input("Selecciona tu opcion: ")
    if opcion == '1': #Al pusar el 1 e introducir el lado del cuadro calcula el perimetro y ela are y lo dibuija
        lado = int(input("Ingrese la longitud del lado del cuadrado: "))
        dibujo_cuadrado(lado)
        area = area_cuadrado(lado)
        perimetro = perimetro_cuadrado(lado)
        print("Área del cuadrado es:", area )
        print("Perímetro del cuadrado es:", perimetro)

    elif opcion == '2': #Al pusar el 2 e introducir el lado y la base del rectangulo calcula el perimetro y el area y lo dibuija
        base = int(input("Introduce la base del rectangulo: "))
        altura = int(input("ingrese la altura del rectangulo: "))
        dibujo_rectangulo (base, altura)
        area2 = area_rectangulo (base, altura)
        perimetro2 = perimetro_rectangulo(base, altura)
        print(f"El area del rectangulo es:", area2)
        print(f"el perimetro del rectangulo es:", perimetro2)

    elif opcion == '3':#Al pulsar el 3 se meustra el mensaje "saliendo del progrma..." y el bucle se acaba
        print("saliendo del progrma...")
        break

    else : #si se pulsa un numero que no sea 1,2 o 3 se mestra el mensaje "opcion no valida"
        print("opcion no valida")
