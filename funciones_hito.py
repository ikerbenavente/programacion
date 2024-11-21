# Diccionarios vacios para almacenar los clientes y pedidos
clientes = {}
pedidos = {}
#Creo un diccionario con los productos, cada producto tiene un id asociado
productos = {
    1: "Teclado",
    2: "Ratón",
    3: "Portatil"
}

# Función para registrar un cliente
def registrar_cliente():
    #Se pide al cliente que ingrese sus datos 
    print("Registro de Cliente:")
    nombre = input("Nombre: ")
    apellidos = input("Apellidos: ")
    direccion = input("Dirección: ")
    telefono = input("Teléfono: ")
    email = input("Correo electronico: ")
    id_cliente = len(clientes) + 1  # Genera un ID unicopara cada registro
    #Crea un id unico para el cliente apartir de los datos que ha introducido
    clientes[id_cliente] = {
        "nombre": nombre,
        "apellidos": apellidos,
        "direccion": direccion,
        "telefono": telefono,
        "Correo electronico": email
    }
    print(f"Cliente registrado con ID: {id_cliente}")

# Función para ver los clientes
def ver_clientes():
    #Si no hay ningun cliente registrado sale el mensaje de error
    if not clientes:
        print("No hay clientes registrados.")
    #si hay clientes registrados imprime todos los clientes con su id, el nombre y el apellido
    else:
        print("Clientes registrados:")
        for id_cliente, datos in clientes.items():
            print(f"ID: {id_cliente}, Nombre: {datos['nombre']} {datos['apellidos']}")
        print()

# Función para realizar una compra
def realizar_pedido():
    #Para hacer un pedido el cliente tiene que estra registrado 
    #si no lo esta sale un mensaje de error 
    id_cliente = int(input("Ingrese el ID del cliente: "))
    if id_cliente not in clientes:
        print("Cliente no registrado.")
        return
    #Si el cliente estaba registrado se imprime una lista con los productos y sus ids
    print("Productos:")
    for id_producto, nombre in productos.items():
        print(f"{id_producto}. {nombre}")
    #Se introduce los numeros de los productos y separados por comas
    seleccion = input("Introduce el numeros de los productos los productos (separados por comas): ")
    productos_seleccionados = seleccion.split(",")
    
    numero_pedido = len(pedidos) + 1  # Crea un número de pedido unico
    pedidos[numero_pedido] = {
        "id_cliente": id_cliente,
        "productos": [productos[int(p)] for p in productos_seleccionados]
    }
    #Mensaje de confirmacion del pedido
    print(f"Pedido realizado con el número: {numero_pedido}")

# Función para seguir un pedido
def seguimiento_pedido():
    numero_pedido = int(input("Ingrese el número de pedido: "))
    if numero_pedido not in pedidos:
        print("Pedido no encontrado.")
        return
#Al hacer el seguimiento del pedido el programa enseña los datos del cliente y los productos
    pedido = pedidos[numero_pedido]
    cliente = clientes[pedido["id_cliente"]]
    print("Datos del cliente:")
    print(f"Nombre: {cliente['nombre']} {cliente['apellidos']}")
    print(f"Dirección: {cliente['direccion']}")
    print(f"Teléfono: {cliente['telefono']}")
    print(f"Email: {cliente['Correo electronico']}")
    print("Productos del pedido:")
    for producto in pedido["productos"]:
        print(f"- {producto}")
    print()