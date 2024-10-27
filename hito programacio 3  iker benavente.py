
# Pedir el saldo inicial
saldo = int(input("Introduce el saldo inicial de la cuenta: "))
contador_ingreso = 0
contador_retiradas = 0
#Menu
while True:
    print("--- Menú ---")
    print("1 - Ingresar dinero")
    print("2 - Retirar dinero")
    print("3 - Mostrar saldo")
    print("4 - Estadísticas")
    print('5 - salir')
    
    # Pedir la opción al usuario
    opcion = input("Selecciona una opción: ")
    
    #Defino opciones
    if opcion == '1': # Ingresar dinero
        cantidad = int(input("Introduce la cantidad a ingresar: "))
        if cantidad > 0:
            saldo += cantidad
            print(f"Has ingresado {cantidad}. Nuevo saldo: {saldo}")
            contador_ingreso = contador_ingreso + 1
        else:
            print('No se pueden ingresar cantidaes negativas')
        
    elif opcion == '2': # Retirar dinero
        cantidad = int(input("Introduce la cantidad a retirar: "))
        if cantidad < saldo:
            saldo -= cantidad
            print(f"Has retirado {cantidad}. Nuevo saldo: {saldo}")
            contador_retiradas = + 1
        else:
            print("No te puedes quedar en números rojos")
    elif opcion == '3': # Mostrar saldo
        print(f"Saldo actual: {saldo}")
    
    elif opcion == '5': # Salir
        print("Saliendo del programa...")
        break
    elif opcion == '4': # Contador de ingresos y retiradas
        print(f'Ha ingresando {contador_ingreso} veces dinero')
        print(f'Ha retirado {contador_retiradas} veces dinero')
    else:
        print("Opción no válida. Por favor, elige de nuevo.")
