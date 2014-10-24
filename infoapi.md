# Información API para peticiones

# User

Con el usuario se pueden realizar las siguientes acciones:
- Registrar usuario:
	URL: /signup
	Datos:
		name
		lastname
		email
		email_confirmation
		password
	Método: POST

- Iniciar sesión: 
	URL: /login
	Datos:
		email
		password
	Método: POST
	
- Editar usuario:
	URL: /signup
	Datos:
		name
		lastname
		email
		email_confirmation
		password
	Método: POST
	
- Cerrar sesión:
	URL: /logout
	Datos:
	Método: GET
	
	
# Vehicle 
(En este punto, se debe tener el auth-token que entrega la aplicación al iniciar sesión, y enviarlo junto con los demás datos
para todas las peticiones.)

Con los vehículos se pueden realizar las siguientes acciones:

- Registrar vehículo:
	URL: /vehicle
	Datos:
		plate (String XXX000 o XXX00X)
		color (string)
		brand (string)
		model (string)
		capacity (int)
		type (int 1. Carros/Camionetas 2. Motos 3. Otros )
	Método: POST
	
- Editar vehículo:
	URL: /vehicle/{id} // id del vehiculo
	Datos:
		
	Método: PUT/PATCH
	
- "Eliminar" vehículo:
	URL: /vehicle/{id} // id del vehículo
	Datos:
	Método: DELETE
	
- Listar vehículos:
	URL: /vehicle
	Datos:
	Método: GET
