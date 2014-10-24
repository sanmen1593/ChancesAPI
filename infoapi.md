# Información API para peticiones

# User

Con el usuario se pueden realizar las siguientes acciones:
- Registrar usuario:
	URL: /signup
	Datos:</br>
		name</br>
		lastname</br>
		email</br>
		email_confirmation</br>
		password</br>
	Método: POST

- Iniciar sesión: 
	URL: /login</br>
	Datos:</br>
		email</br>
		password</br>
	Método: POST</br>

- Editar usuario:
	URL: /signup</br>
	Datos:</br>
		name</br>
		lastname</br>
		email</br>
		email_confirmation</br>
		password</br>
	Método: POST
	
- Cerrar sesión:</br>
	URL: /logout</br>
	Datos:</br>
	Método: GET</br>
	
	
# Vehicle 
(En este punto, se debe tener el auth-token que entrega la aplicación al iniciar sesión, y enviarlo junto con los demás datos
para todas las peticiones.)

Con los vehículos se pueden realizar las siguientes acciones:

- Registrar vehículo:
	URL: /vehicle</br>
	Datos:</br>
		plate (String XXX000 o XXX00X)</br>
		color (string)</br>
		brand (string)</br>
		model (string)</br>
		capacity (int)</br>
		type (int 1. Carros/Camionetas 2. Motos 3. Otros )</br>
	Método: POST</br>
	
- Editar vehículo:</br>
	URL: /vehicle/{id} // id del vehiculo</br>
	Datos:</br>
		
	Método: PUT/PATCH</br>
	
- "Eliminar" vehículo:</br>
	URL: /vehicle/{id} // id del vehículo</br>
	Datos:</br>
	Método: DELETE</br>
	
- Listar vehículos:
	URL: /vehicle</br>
	Datos:</br>
	Método: GET</br>
