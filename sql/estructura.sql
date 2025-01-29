CREATE TABLE bodegas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE sucursales (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    bodega_id INT REFERENCES bodegas(id)
);

CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(15) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    bodega_id INT REFERENCES bodegas(id),
    sucursal_id INT REFERENCES sucursales(id),
    moneda VARCHAR(10) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    materiales VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL
);

INSERT INTO bodegas (nombre) VALUES
('Bodega Central - Lima'),
('Bodega Norte - San Martín de Porres'),
('Bodega Sur - Surco'),
('Bodega Este - Ate'),
('Bodega Oeste - Callao');

INSERT INTO sucursales (nombre, bodega_id) VALUES
('Sucursal Miraflores', 1),
('Sucursal Barranco', 1),
('Sucursal San Isidro', 1),
('Sucursal Jesús María', 1),
('Sucursal Lince', 1),
('Sucursal Pueblo Libre', 1),

('Sucursal Los Olivos', 2),
('Sucursal Comas', 2),
('Sucursal Independencia', 2),
('Sucursal Rímac', 2),
('Sucursal Puente Piedra', 2),

('Sucursal Santiago de Surco', 3),
('Sucursal Chorrillos', 3),
('Sucursal Villa El Salvador', 3),
('Sucursal Lurín', 3),
('Sucursal Pachacámac', 3),

('Sucursal Santa Anita', 4),
('Sucursal La Molina', 4),
('Sucursal Ate Vitarte', 4),
('Sucursal El Agustino', 4),
('Sucursal Huaycán', 4),

('Sucursal Callao Centro', 5),
('Sucursal Ventanilla', 5),
('Sucursal La Perla', 5),
('Sucursal Bellavista', 5),
('Sucursal Carmen de La Legua', 5);
