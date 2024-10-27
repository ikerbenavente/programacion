#menu
import random
eleccion = int(input("Piedra, Papel o Tijera(1,2 o 3): "))
contador_victorias = 0
contador_derrotas = 0
#acciones del juigador 
if eleccion == 1:
      print("Has elegido: piedra")
elif eleccion==2:
      print("Has elegido: papel")
elif eleccion == 3:
      print("Has elegido: tijera")

#acciones de la maquina
rival = random.randint(1,3)

if  rival == 1:
     print("El ha elegido: piedra")
elif rival == 2:
     print("El ha elegido: papel")
elif rival  == 3:
     print("El ha elegido: tijera")

# resultados
if rival == eleccion:
     print("empate")
     
elif rival < eleccion:
     print("¡Has gando!")
     contador_victorias += 1
else:
     print("¡Has perdido!")
     contador_derrotas += 1

     print(f"Vais: {contador_victorias} - {contador_derrotas}")




