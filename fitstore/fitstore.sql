CREATE TABLE IF NOT EXISTS productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  vendedor_nombre VARCHAR(100),
  vendedor_email VARCHAR(120),
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO productos (id, titulo, descripcion, precio, imagen)
VALUES
(1, 'Almohadilla para Barras Olímpicas',
 'Ideal para entrenamientos de fuerza.',
 20000.00, 'almohadilla.jpg'),

(2, 'Muñequeras Nike PRO',
 'Muñequeras deportivas para mayor estabilidad de muñeca durante el entrenamiento.',
 35000.00, 'muñequera.jpg'),

(3, 'Rueda abdominal',
 'Perfecta para trabajar core y abdominales en casa o en el gimnasio.',
 15200.00, 'ruedita.jpg'),

(4, 'Guantes de Entrenamiento Nike Pro',
 'Guantes acolchados para mejorar el agarre y proteger las manos en levantamiento de pesas.',
 42000.00, 'guantes.jpg'),

(5, 'Bandas Elásticas (Set x3)',
 'Set de bandas de resistencia ideal para movilidad y entrenamiento funcional.',
 12400.00, 'bandas.jpg'),

(6, 'Cintas de Levantamiento Straps ECO',
 'Cintas de levantamiento para mejorar el agarre en ejercicios de tracción.',
 18000.00, 'CintaStraps.png'),

(7, 'Colchoneta MIR Fitness',
 'Colchoneta acolchada ideal para ejercicios en el suelo y estiramientos.',
 39300.00, 'colchoneta.jpg'),

(8, 'Collarines Plásticos para Barras',
 'Collarines de plástico para asegurar discos en barras olímpicas.',
 18000.00, 'CollarinesPlasticos.jpg'),

(9, 'Botella Shaker ENA',
 'Shaker para batidos de proteínas con compartimento para suplementos.',
 9200.00, 'shaker.jpg');
