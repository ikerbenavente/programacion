#Se importan las funcioes del archivo funciones_hito
import funciones_hito as fh
#Se hace una funcion para el menu 
def menu():
    while True:
        print("Selecciona una opcion:")
        print("1. Registrar cliente")
        print("2. Ver clientes")
        print("3. Realizar pedido")
        print("4. Seguimiento del pedido")
        print("5. Salir")
        
        opcion = input("Seleccione una opción: ")
        #Defino las acciones que puede hacer el usuario
        #Llamo a las funciones del archivo de funciones 
        if opcion == '1':
            fh.registrar_cliente()
        elif opcion == '2':
            fh.ver_clientes()
        elif opcion == '3':
            fh.realizar_pedido()
        elif opcion == '4':
            fh.seguimiento_pedido()
        elif opcion == '5':
            print("Saliendo del programa...")
            break
        #Si introduce una opcion que no esta en el menu sale un mensaje de error
        else:
            print("Opción no válida.")
