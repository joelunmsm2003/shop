<!DOCTYPE html>


<div id="container">

<canvas id="canvas" width="300" height="300"></div>

<style type="text/css">
canvas {
    position: absolute;
    top: 0;
    left: 0;
    border: solid 1px #000;
}

</style>

<script type="text/javascript">

var Map = function() {
    this.width = 10 * Map.UNIT;
    this.height = 10 * Map.UNIT;
};

// Unidad minima de medida, cada bloque tendra una unidad (20px)
Map.UNIT = 20;

Map.prototype.fill = function() {
    var ctx, map, seed;

    ctx = this.canvas.getContext('2d');
    map = this.map = [];
    seed = this.seed();    
    
    // Recorremos el array generado
    seed.forEach(function(current, index) {
        var x, y;

        x = (index % 10);
        // Sobre el eje y usamos una densidad menor (1/3)
        y = Math.ceil(index / 3);

        if (current != '0') {
            ctx.fillRect(x * Map.UNIT, y * Map.UNIT, Map.UNIT, Map.UNIT);
            
            // Registramos el obstaculo
            map[y * 10 + x] = true;
        }
    });
};

// Genera un array de 30 posiciones de '1' y '0' que usaremos como mapa
Map.prototype.seed = function() {
    return Math.floor(
        Math.pow(2, Map.UNIT) | (Math.random() * Math.pow(2, Map.UNIT))
    ).toString(2).split('');
};

// Verifica si la coordenada (x, y) es "caminable"
Map.prototype.check = function(x, y) {    
    // Validamos que no se salga por izquierda ni derecha
    if(x > 9|| x < 0) {
        return false;        
    }
    
    // Ni por abajo ni arriba de lo permitido
    if(y > 9|| y < 0) {
        return false;       
    }      
    
    // Luego, nos fijamos que no exista un obstaculo en dicha
    // posicion
    return !this.map[y * 10 + x];
};

Map.prototype.renderTo = function(container) {
    this.canvas = $('<canvas/>')
        .attr('width', this.width)
        .attr('height', this.height).get(0);
    
    // Rellenamos el mapa con obstaculos
    this.fill();

    $(container).append(this.canvas);
};

//-----------------------------------------------------------------------------
var Char = function(map) {
    this.map = map;
    this.width = 10 * Map.UNIT;
    this.height = 10 * Map.UNIT;

    this.x = 9;
    this.y = 9;
};

// Nuestra funcion que dibuja el "personaje"
Char.prototype.render = function() {
    var ctx = this.canvas.getContext('2d');

    ctx.fillStyle = '#0f0';
    ctx.fillRect(this.x * Map.UNIT, this.y * Map.UNIT, Map.UNIT, Map.UNIT);
};

Char.prototype.move = function(x, y) {
    var ctx, expectedX, expectedY;

    ctx = this.canvas.getContext('2d');
    
    // Las nuevas coordenadas son una variacion de las
    // actuales
    expectedX = x + this.x;
    expectedY = y + this.y;

    // Validamos que sea una coordenada valida
    if(!this.map.check(expectedX , expectedY)) {
        return;            
    }
    
    // Borramos nuestro personaje (del cual conocemos su posicion)
    ctx.clearRect(this.x * Map.UNIT, this.y * Map.UNIT, Map.UNIT, Map.UNIT);  
    
    this.x = expectedX ;
    this.y = expectedY;
    
    // Y lo dibujamos nuevamente
    this.render();
};

// Nuestro event handler, controla el movimiento
// del "personaje"
Char.prototype.initEvents = function() {
    var self = this;
    
    $(document).keydown(function(ev) {            
        switch (ev.which) {
            case 37: // left
                self.move(-1, 0);                
                break;
            case 38: // up
                self.move(0, -1);            
                break;
            case 39: // right
                self.move(1, 0);
                break;
            case 40: // down
                self.move(0, 1);
                break;
        }                    
    });
};

Char.prototype.renderTo = function(container) {
    this.canvas = $('<canvas/>')
        .attr('width', this.width)
        .attr('height', this.height)
        .get(0);

    // Dibujamos la posicion inicial (9, 9)
    // que esta siempre vacia
    this.render();
    
    // Iniciamos los eventoes
    this.initEvents();

    $(container).append(this.canvas);
};

//-----------------------------------------------------------------------------

var map = new Map;
var char = new Char(map);

map.renderTo($('#container'));
char.renderTo($('#container'));

</script>


</html>