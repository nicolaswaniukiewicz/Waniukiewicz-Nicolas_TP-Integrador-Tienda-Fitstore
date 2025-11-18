// Obtener el parámetro 'id' de la URL
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('id');

// Ahora, usar el 'productId' para cargar la información del producto desde un array o base de datos
const productos = [
  { id: 1, nombre: 'Almohadilla para Barras Olímpicas', precio: '$20.000', descripcion: 'Almohadilla de alta densidad diseñada para barras olímpicas, brinda mayor comodidad y protección en hombros y cuello durante sentadillas y ejercicios de fuerza. Su ajuste seguro evita deslizamientos, mejorando la experiencia de entrenamiento.', imagen: 'almohadilla.jpg' },
  { id: 2, nombre: 'Muñequeras Nike PRO', precio: '$35.000', descripcion: 'Muñequeras de compresión que ofrecen soporte y estabilidad a las muñecas durante entrenamientos intensos. Ideales para levantamiento de pesas y ejercicios funcionales, ayudan a prevenir lesiones y mejorar el rendimiento.', imagen: 'muñequera.jpg' },
  { id: 3, nombre: 'Rueda abdominal', precio: '$15.200', descripcion: 'Rueda de entrenamiento resistente con agarres antideslizantes, perfecta para trabajar abdomen, brazos y espalda. Favorece la estabilidad del core y permite realizar ejercicios efectivos en casa o en el gimnasio.', imagen: 'ruedita.jpg' },
  { id: 4, nombre: 'Guantes de Entrenamiento Nike Pro', precio: '$42.000', descripcion: 'Guantes diseñados para brindar comodidad, protección y mejor agarre durante tus entrenamientos. Su diseño transpirable mantiene las manos frescas, mientras que las palmas acolchadas reducen la fricción y evitan ampollas. Ideales para levantamiento de pesas y rutinas de gimnasio.', imagen: 'guantes.jpg' },
  { id: 5, nombre: 'Bandas Elásticas (Set x3)', precio: '$12.400', descripcion: 'Ideales para entrenamientos de fuerza, tonificación y rehabilitación. Fabricadas en material resistente y antideslizante, ofrecen distintos niveles de resistencia para adaptarse a todo tipo de rutinas, desde glúteos y piernas hasta brazos y abdomen. Portátiles, cómodas y versátiles para usar en casa, gimnasio o al aire libre.', imagen: 'bandas.jpg'},
  { id: 6, nombre: 'Cintas de Levantamiento Straps ECO', precio: '$17.500', descripcion: 'Diseñadas para mejorar el agarre y la seguridad en tus entrenamientos de fuerza. Fabricadas en material resistente y duradero, ayudan a reducir la fatiga en las manos y muñecas, permitiendo levantar más peso con mayor estabilidad. Ideales para ejercicios como peso muerto, dominadas o remos.', imagen: 'CintaStraps.png'},
  { id: 7, nombre: 'Colchoneta MIR Fitness', precio: '$39.300', descripcion: 'Colchoneta MIR Fitness, ideal para entrenamientos funcionales, yoga, pilates y ejercicios de suelo. Ofrece comodidad y soporte gracias a su acolchado firme, protegiendo articulaciones y brindando estabilidad durante la práctica. Su superficie es resistente y fácil de limpiar, perfecta para uso en casa o en el gimnasio.', imagen: 'colchoneta.jpg'},
  { id: 8, nombre: 'Botella Shaker ENA', precio: '$25.000', descripcion: 'Botella mezcladora ideal para tus suplementos y bebidas deportivas. Con capacidad de 700 ml, cuenta con un diseño ergonómico y una tapa segura para evitar derrames. Incluye una bola mezcladora para asegurar una mezcla homogénea de tus proteínas, batidos o bebidas energéticas. Perfecta para llevar al gimnasio, trabajo o actividades al aire libre.', imagen: 'shaker.jpg'},
  { id: 9, nombre: 'Collarines Plásticos', precio: '$16.700', descripcion: 'Collarines plásticos ajustables para barras olímpicas de 50 mm de diámetro. Fabricados en material resistente y duradero, ofrecen un ajuste seguro para evitar movimientos indeseados durante tus levantamientos. Fáciles de colocar y quitar, son ideales para entrenamientos de fuerza y levantamiento de pesas.', imagen: 'CollarinesPlasticos.jpg'},
];

// Buscar el producto por su ID
const producto = productos.find(p => p.id == productId);

// Mostrar los detalles del producto
if (producto) {
  document.getElementById('producto-nombre').innerText = producto.nombre;
  document.getElementById('producto-precio').innerText = producto.precio;
  document.getElementById('producto-descripcion').innerText = producto.descripcion;
  document.getElementById('producto-imagen').src = `img/${producto.imagen}`;
} else {
  // Si el producto no existe, mostrar un mensaje de error
  document.getElementById('producto-nombre').innerText = 'Producto no encontrado';
  document.getElementById('producto-precio').innerText = '';
  document.getElementById('producto-descripcion').innerText = '';
  document.getElementById('producto-imagen').src = 'img/no-disponible.jpg';
}

