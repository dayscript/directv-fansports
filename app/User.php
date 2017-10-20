<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last', 'email', 'password', 'phone', 'gender', 'country', 'city', 'promotions', 'identification_type', 'identification'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Generates full name attribute
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last;
    }

    /**
     * Returns all predictions for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    /**
     * Returns all codes for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    /**
     * Updates total user points
     * @return int
     */
    public function updatePoints()
    {
        $total = 0;
        foreach ($this->predictions as $prediction) {
            $total += $prediction->points;
        }
        $this->points = $total;
        $this->save();
        return $total;
    }

    /**
     * Leagues owned by this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function myleagues()
    {
        return $this->hasMany(League::class);
    }

    /**
     * Leagues of this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leagues()
    {
        return $this->belongsToMany(League::class)->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Colombian cities
     */
    public static function cities()
    {
        $data = ["Amazonas"           => ["Leticia", "Puerto Narino"],
                 "Antioquia"          => ["Abejorral", "Abriaqui", "Alejandria", "Amaga", "Amalfi", "Andes", "Angelopolis", "Angostura", "Anori", "Antioquia", "Anza", "Apartado", "Arboletes", "Argelia", "Armenia", "Barbosa", "Belmira", "Bello", "Betania", "Betulia", "Bolivar", "Briseno", "Buritica", "Caceres", "Caicedo", "Caldas", "Campamento", "Canasgordas", "Caracoli", "Caramanta", "Carepa", "Carmen de Viboral", "Carolina", "Caucasia", "Chigorodo", "Cisneros", "Cocorna", "Concepcion", "Concordia", "Copacabana", "Dabeiba", "Don Matias", "Ebejico", "El Bagre", "Entrerrios", "Envigado", "Fredonia", "Frontino", "Giraldo", "Girardota", "Gomez Plata", "Granada", "Guadalupe", "Guarne", "Guatape", "Heliconia", "Hispania", "Itagui", "Ituango", "Jardin", "Jerico", "La Ceja", "La Estrella", "La Pintada", "La Union", "Liborina", "Maceo", "Marinilla", "Medellin", "Montebello", "Murindo", "Mutata", "Narino", "Necocli", "Nechi", "Olaya", "Penol", "Peque", "Pueblorrico", "Puerto Berrio", "Puerto Nare", "Puerto Triunfo", "Remedios", "Retiro", "Rionegro", "Sabanalarga", "Sabaneta", "Salgar", "San Andres", "San Carlos", "San francisco", "San Jeronimo", "San Jose de Montana", "San Juan de Uraba", "San Luis", "San Pedro", "San Pedro de Uraba", "San Rafael", "San Roque", "San Vicente", "Santa Barbara", "Santa Rosa de Osos", "Santo Domingo", "Santuario", "Segovia", "Sonson", "Sopetran", "Tamesis", "Taraza", "Tarso", "Titiribi", "Toledo", "Turbo", "Uramita", "Urrao", "Valdivia", "Valparaiso", "Vegachi", "Venecia", "Vigia del Fuerte", "Yali", "Yarumal", "Yolombo", "Yondo (Casabe)", "Zaragoza"],
                 "Arauca"             => ["Arauca", "Arauquita", "Cravo Norte", "Fortul", "Saravena", "Tame"],
                 "Atlantico"          => ["Barranquilla", "Baranoa", "Campo de la Cruz", "Candelaria", "Galapa", "Juan de Acosta", "Luruaco", "Malambo", "Manati", "Palmar de Varela", "Piojo", "Polonuevo", "Ponedera", "Puerto Colombia", "Repelon", "Sabanagrande", "Sabanalarga", "Santa Lucia", "Santo Tomas", "Soledad", "Suan", "Tubara", "Usiacuri", "Cartagena", "Achi", "Altos del Rosario", "Arenal", "Arjona", "Arroyohondo", "Barranco de Loba", "Calamar", "Cantagallo", "Cicuto", "Cordoba", "Clemencia", "El Carmen de Bolivar", "El Guamo", "El Penon", "Hatillo de Loba", "Magangue", "Mahates", "Margarita", "Maria la Baja", "Montecristo", "Mompos", "Morales", "Pinillos", "Regidor", "Rio Viejo", "San Cristobal", "San Estanislao", "San Fernando", "San Jacinto", "San Jacinto del Cauca", "San Juan Nepomuceno", "San Martin de Loba", "San Pablo", "Santa Catalina", "Santa Rosa", "Santa Rosa del Sur", "Simiti", "Soplaviento", "Talaigua Nuevo", "Tiquisio (Puerto Rico)", "Turbaco", "Turbana", "Villanueva", "Zambrano"],
                 "Boyaca"             => ["Almeida", "Aquitania", "Arcabuco", "Belen", "Berbeo", "Beteitiva", "Boavita", "Boyaca", "Briseno", "Buenavista", "Busbanza", "Caldas", "Campohermoso", "Cerinza", "Chinavita", "Chiquinquira", "Chiscas", "Chita", "Chitaranque", "Chivata", "Cienaga", "Combita", "Coper", "Corrales", "Covarachia", "Cubar", "Cucaita", "Cuitiva", "Chiquiza", "Chivor", "Duitama", "El Cocuy", "El Espino", "Firavitoba", "Floresta", "Gachantiva", "Gameza", "Garagoa", "Guacamayas", "Guateque", "Guayata", "Guican", "Iza", "Jenesano", "Jerico", "Labranzagrande", "La Capilla", "La Victoria", "La Ubita", "Villa de Leyva", "Macanal", "Maripi", "Miraflores", "Mongua", "Mongui", "Moniquira", "Motavita", "Muzo", "Nobsa", "Nuevo Colon", "Oicata", "Otanche", "Pachavita", "Paez", "Paipa", "Pajarito", "Panqueba", "Pauna", "Paya", "Paz de Rio", "Pesca", "Pisva", "Puerto Boyaca", "Quipama", "Ramiquiri", "Raquira", "Rondon", "Saboya", "Sachica", "Samaca", "San Eduardo", "San Jose de Pare", "San Luis de Gaceno", "San Mateo", "San Miguel de Sema", "San Pablo de Borbur", "Santana", "Santa Maria", "Santa Rosa de Viterbo", "Santa Sofia", "Sativanorte", "Sativasur", "Siachoque", "Soata", "Socota", "Socha", "Sogamoso", "Somondoco", "Sora", "Sotaquira", "Soraca", "Susacon", "Sutamarchan", "Sutatenza", "Tasco", "Tenza", "Tibana", "Tibasosa", "Tinjaca", "Tipacoque", "Toca", "Togui", "Topaga", "Tota", "Tunja", "Tunungua", "Turmeque", "Tuta", "Tutaza", "Umbita", "Ventaquemada", "Viracacha", "Zetaquira"],
                 "Caldas"             => ["Aguadas", "Anserma", "Aranzazu", "Belalcazar", "Chinchina", "Filadelfia", "La Dorada", "La Merced", "Manizales", "Manzanares", "Marmato", "Marquetalia", "Marulanda", "Neira", "Pacora", "Palestina", "Pensilvania", "Riosucio", "Risaralda", "Salamina", "Samana", "San Jose", "Supia", "Victoria", "Villamaria", "Viterbo"],
                 "Caqueta"            => ["Albania", "Belen de los Andaquies", "Cartagena del Chaira", "Curillo", "El Doncello", "El Paujil", "Florencia", "La Montanita", "Milan", "Morelia", "Puerto Rico", "San Jose del Fragua", "San Vicente del Caguan", "Solano", "Solita", "Valparaiso"],
                 "Casanare"           => ["Aguazul", "Chameza", "Hato Corozal", "La Salina", "Mani", "Monterrey", "Nunchia", "Orocue", "Paz de Ariporo", "Pore", "Recetor", "Sabalarga", "Sacama", "San Luis de Palenque", "Tamara", "Tauramena", "Trinidad", "Villanueva", "Yopal"],
                 "Cauca"              => ["Almaguer", "Argelia", "Balboa", "Bolivar", "Buenos Aires", "Cajibio", "Caldono", "Caloto", "Corinto", "El Tambo", "Florencia", "Guapi", "Inza", "Jambalo", "La Sierra", "La Vega", "Lopez (Micay)", "Mercaderes", "Miranda", "Morales", "Padilla", "Paez (Belalcazar)", "Patia (El Bordo)", "Piamonte", "Piendamo", "Popayan", "Puerto Tejada", "Purace (Coconuco)", "Rosas", "San Sebastian", "Santander de Quilichao", "Santa Rosa", "Silvia", "Sotara (Paispamba)", "Suarez", "Timbio", "Timbiqui", "Toribio", "Totoro"],
                 "Cesar"              => ["Aguachica", "Agustin Codazzi", "Astrea", "Becerril", "Bosconia", "Chimichagua", "Chiriguana", "Curumani", "El Copey", "El Paso", "Gamarra", "Gonzalez", "La Gloria", "La Jagua de Ibirico", "Manaure Balcon Cesar", "Pailitas", "Pelaya", "Pueblo Bello", "Rio de Oro", "La Paz (Robles)", "San Alberto", "San Diego", "San Martin", "Tamalameque", "Valledupar"],
                 "Cordoba"            => ["Ayapel", "Buenavista", "Canalete", "Cerete", "Chima", "Chinu", "Cienaga de Oro", "Cotorra", "La Apartada (Frontera)", "Lorica", "Los Cordobas", "Momil", "Monitos", "Montelibano", "Monteria", "Planeta Rica", "Pueblo Nuevo", "Puerto Escondido", "Puerto Libertador", "Purisima", "Sahagun", "San Andres Sotavento", "San Antero", "San Bernardo del Viento", "San Carlos", "San Pelayo", "Tierralta", "Valencia"],
                 "Cundinamarca"       => ["Agua de Dios", "Alban", "Anapoima", "Anolaima", "Arbelaez", "Beltran", "Bituima", "Bojaca", "Cabrera", "Cachipay", "Cajica", "Caparrapi", "Caqueza", "Carmen de Carupa", "Chaguani", "Chia", "Chipaque", "Choachi", "Choconta", "Cogua", "Cota", "Cucunuba", "El Colegio", "El Penon", "El Rosal", "Facatativa", "Fomeque", "Fosca", "Funza", "Fuquene", "Fusagasuga", "Gachala", "Gachancipa", "Gacheta", "Gama", "Girardot", "Granada", "Guacheta", "Guaduas", "Guasca", "Guataqui", "Guatavita", "Guayabal de Siquima", "Guayabetal", "Gutierrez", "Jerusalen", "Junin", "La Calera", "La Mesa", "La Palma", "La Pena", "La Vega", "Lenguazaque", "Macheta", "Madrid", "Manta", "Medina", "Mosquera", "Narino", "Nemocon", "Nilo", "Nimaima", "Nocaima", "Venecia (Ospina Perez)", "Pacho", "Paime", "Pandi", "Paratebueno", "Pasca", "Puerto Salgar", "Puli", "Quebradanegra", "Quetame", "Quipile", "Rafael", "Ricaurte", "San Antonio de Tequendama", "San Bernardo", "San Cayetano", "San Francisco", "San Juan de Rioseco", "Sasaima", "Sesquile", "Sibate", "Silvania", "Simijaca", "Soacha", "Sopo", "Subachoque", "Suesca", "Supata", "Susa", "Sutatausa", "Tabio", "Tausa", "Tena", "Tenjo", "Tibacuy", "Tibirita", "Tocaima", "Tocancipa", "Topaipi", "Ubala", "Ubaque", "Ubate", "Une", "utica", "Vergara", "Viani", "Villagomez", "Villapinzon", "Villeta", "Viota", "Yacopi", "Zipacon", "Zipaquira"],
                 "Choco"              => ["Acandi", "Alto Baudo (Pie de Pato)", "Atrato (Yuto)", "Bagado", "Bahia Solano (Mutis)", "Bajo Baudo (Pizarro)", "Bojaya (Bellavista)", "Canton de San Pablo", "Condoto", "El Carmen", "El Litoral de San Juan", "Itsmina", "Jurado", "Lloro", "Novita", "Nuqui", "Quibdo", "Riosucio", "San Jose del Palmar", "Sipi", "Tado", "Unguia"],
                 "Guainia"            => ["Puerto Inirida"],
                 "Guaviare"           => ["Calamar", "El Retorno", "Miraflores", "San Jose del Guaviare"],
                 "Huila"              => ["Acevedo", "Agrado", "Aipe", "Algeciras", "Altamira", "Baraya", "Campoalegre", "Colombia", "Elias", "Garzon", "Gigante", "Guadalupe", "Hobo", "Iquira", "Isnos", "La Argentina", "La Plata", "Nataga", "Neiva", "Oporapa", "Paicol", "Palermo", "Palestina", "Pital", "Pitalito", "Rivera", "Saladoblanco", "San Agustin", "Santa Maria", "Suaza", "Tarqui", "Tesalia", "Tello", "Teruel", "Timana", "Villavieja", "Yaguara"],
                 "La Guajira"         => ["Barrancas", "Dibulla", "Distraccion", "El Molino", "Fonseca", "Hatonuevo", "Maicao", "Manaure", "Riohacha", "San Juan del Cesar", "Uribia", "Urumita", "Villanueva"],
                 "Magdalena"          => ["Aracataca", "Ariguani (El Dificil)", "Cerro San Antonio", "Chivolo", "Cienaga", "El Banco", "El Pinon", "El Reten", "Fundacion", "Guamal", "Pedraza", "Pijino del Carmen", "Pivijay", "Plato", "Publoviejo", "Remolino", "Salamina", "San Sebastian de Buuenavista", "San Zenon", "Santa Ana", "Santa Marta", "Sitionuevo", "Tenerife"],
                 "Meta"               => ["Acacias", "Barranca de Upia", "Cabuyaro", "Castilla la Nueva", "Cubarral", "Cumaral", "El Calvario", "El Castillo", "El Dorado", "Fuente de Oro", "Granada", "Guamal", "Mapiripan", "Mesetas", "La Macarena", "La Uribe", "Lejanias", "Puerto Concordia", "Puerto Gaitan", "Puerto Lopez", "Puerto Lleras", "Puerto Rico", "Restrepo", "San Carlos de Guaroa", "San Juan de Arama", "San Juanito", "San Martin", "Villavicencio", "Vistahermosa"],
                 "Narino"             => ["Alban (San Jose)", "Aldana", "Ancuya", "Arboleda (Berruecos)", "Barbacoas", "Belen", "Buesaco", "Colon (Genova)", "Consaca", "Contadero", "Cordoba", "Cuaspud (Carlosama)", "Cumbal", "Cumbitara", "Chachagui", "El Charco", "El Rosario", "El Tablon", "El Tambo", "Francisco Pizarro", "Funes", "Guachucal", "Guaitarilla", "Gualmatan", "Iles", "Imues", "Ipiales", "La Cruz", "La Florida", "La Llanada", "La Tola", "La Union", "Leiva", "Linares", "Los Andes (Sotomayor)", "Magui (Payan)", "Mallama (Piedrancha)", "Mosquera", "Olaya", "Ospina", "Pasto", "Policarpa", "Potosi", "Providencia", "Puerres", "Pupiales", "Ricaurte", "Roberto Payan (San Jose)", "Samaniego", "Sandona", "San Bernardo", "San Lorenzo", "San Pablo", "San Pedro de Cartago", "Santa Barbara (Iscuande)", "Santa Cruz (Guachavez)", "Sapuyes", "Taminango", "Tangua", "Tumaco", "Tuquerres", "Yacuanquer"],
                 "Norte de Santander" => ["Abrego", "Arboledas", "Bochalema", "Bucarasica", "Cacota", "Cachira", "Chinacota", "Chitaga", "Convencion", "Cucuta", "Cucutilla", "Durania", "El Carmen", "El Tarra", "El Zulia", "Gramalote", "Hacari", "Herran", "Labateca", "La Esperanza", "La Playa", "Los Patios", "Lourdes", "Mutiscua", "Ocana", "Pamplona", "Pamplonita", "Puerto Santander", "Ragonvalia", "Salazar", "San Calixto", "San Cayetano", "Santiago", "Sardinata", "Silos", "Teorama", "Tibu", "Toledo", "Villacaro", "Villa del Rosario"],
                 "Putumayo"           => ["Colon", "Mocoa", "Orito", "Puerto Asis", "Puerto Caicedo", "Puerto Guzman", "Puerto Leguizamo", "Sibundoy", "San Francisco", "San Miguel", "Santiago", "Villa Gamuez (La Hormiga)", "Villa Garzon"],
                 "Quindio"            => ["Armenia", "Buenavista", "Calarca", "Circasia", "Cordoba", "Filandia", "Genova", "La Tebaida", "Montenegro", "Pijao", "Quimbaya", "Salento"],
                 "Risaralda"          => ["Apia", "Balboa", "Belen de Umbria", "Dos Quebradas", "Guatica", "La Celia", "La Virginia", "Marsella", "Mistrato", "Pereira", "Pueblo Rico", "Quinchia", "Santa Rosa de Cabal", "Santuario"],
                 "San Andres"         => ["Providencia", "San Andres"],
                 "Bogota"             => ["Bogotá"],
                 "Santander"          => ["Aguada", "Albania", "Aratoca", "Barbosa", "Barichara", "Barrancabermeja", "Betulia", "Bolivar", "Bucaramanga", "Cabrera", "California", "Capitanejo", "Carcasi", "Cepita", "Cerrito", "Charala", "Charta", "Chima", "Chipata", "Cimitarra", "Concepcion", "Confines", "Contratacion", "Coromoro", "Curiti", "El Carmen", "El Guacamayo", "El Penon", "El Playon", "Encino", "Enciso", "Florian", "Floridablanca", "Galan", "Gambita", "Giron", "Guaca", "Guadalupe", "Guapota", "Guavata", "Guepsa", "Hato", "Jesus Maria", "Jordan", "La Belleza", "Landazuri", "La Paz", "Lebrija", "Los Santos", "Macaravita", "Malaga", "Matanza", "Mogotes", "Molagavita", "Ocamonte", "Oiba", "Onzaga", "Palmar", "Palmas del Socorro", "Paramo", "Pie de Cuesta", "Pinchote", "Puente Nacional", "Puerto Parra", "Puerto Wilches", "Rionegro", "Sabana de Torres", "San Andres", "San Benito", "San Gil", "San Joaquin", "San Jose de Miranda", "San Miguel", "San Vicente de Chucuri", "Santa Barbara", "Santa Helena del Opon", "Simacota", "Socorro", "Suaita", "Sucre", "Surata", "Tona", "Valle de San Jose", "Velez", "Vetas", "Villanueva", "Zapatoca"],
                 "Sucre"              => ["Buenavista", "Caimito", "Coloso (Ricaurte)", "Corozal", "Chalan", "Galeras (Nueva Granada)", "Guaranda", "La Union", "Los Palmitos", "Majagual", "Morroa", "Ovejas", "Palmito", "Sampues", "San Benito Abad", "San Juan de Betulia", "San Marcos", "San Onofre", "San Pedro", "Since", "Sincelejo", "Sucre", "Tolu", "Toluviejo"],
                 "Tolima"             => ["Alpujarra", "Alvarado", "Ambalema", "Anzoategui", "Armero (Guayabal)", "Ataco", "Cajamarca", "Carmen de Apicala", "Casabianca", "Chaparral", "Coello", "Coyaima", "Cunday", "Dolores", "Espinal", "Falan", "Flandes", "Fresno", "Guamo", "Herveo", "Honda", "Ibague", "Icononzo", "Lerida", "Libano", "Mariquita", "Melgar", "Murillo", "Natagaima", "Ortega", "Palocabildo", "Piedras", "Planadas", "Prado", "Purificacion", "Rioblanco", "Roncesvalles", "Rovira", "Saldana", "San Antonio", "San Luis", "Santa Isabel", "Suarez", "Valle de San Juan", "Venadillo", "Villahermosa", "Villarrica"],
                 "Valle"              => ["Alcala", "Andalucia", "Ansermanuevo", "Argelia", "Bolivar", "Buenaventura", "Buga", "Bugalagrande", "Caicedonia", "Cali", "Calima (Darien)", "Candelaria", "Cartago", "Dagua", "El aguila", "El Cairo", "El Cerrito", "El Dovio", "Florida", "Ginebra", "Guacari", "Jamundi", "La Cumbre", "La Union", "La Victoria", "Obando", "Palmira", "Pradera", "Restrepo", "Riofrio", "Roldanillo", "San Pedro", "Sevilla", "Toro", "Trujillo", "Tulua", "Ulloa", "Versalles", "Vijes", "Yotoco", "Yumbo", "Zarzal"],
                 "Vaupes"             => ["Caruru", "Mitu", "Tatama"],
                 "Vichada"            => ["La Primavera", "Puerto Carreno", "Santa Rosalia", "Cumaribo"]
        ];
        return $data;
    }
}
