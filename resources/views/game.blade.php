@extends('layouts.app')

@section('content')
    <game :rounds="{{ $rounds }}" selected_round="{{ $selected_round->name??'' }}"></game>
    <div class="row">
        <div class="medium-12 columns">
            <hr>
            <div class="row columns encabezado hide-for-small-only">
                <div class="medium-1 columns text-left">Fecha</div>
                <div class="medium-1 columns text-center">Estado</div>
                <div class="medium-2 columns text-right">Local</div>
                <div class="medium-3 columns text-center">Pronóstico</div>
                <div class="medium-2 columns text-left">Visitante</div>
                <div class="medium-1 columns text-center">Marcador</div>
                <div class="medium-1 columns text-center">Puntos</div>
                <div class="medium-1 columns text-right"></div>
            </div>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row item column gutter-small partido">
                <div class="medium-1 columns fecha text-left"> Ago.17 19:30</div>
                <div class="medium-1 columns text-center"><i class="fi-lock"></i></div>
                <div class="small-6 medium-2 columns text-right home">Manchester<i class="fi-shield"></i></div>
                <div class="small-6 medium-2 medium-push-3 columns text-left away"><i class="fi-shield"></i>Liverpool</div>
                <div class="small-12 medium-3 medium-pull-2 columns text-center">
                    <div class="row text-center">
                        <fieldset class="text-center pronostico">
                            <input type="radio" name="pronostico" value="GanaLocal" id="ganaLocal" required><label for="ganaLocal">Gana</label>
                            <input type="radio" name="pronostico" value="Empate" id="empate"><label for="empate">Empate</label>
                            <input type="radio" name="pronostico" value="GanaVisitante" id="ganaVisitante"><label for="ganaVisitante">Gana</label>
                        </fieldset>
                    </div>
                </div>

                <div class="small-4 medium-1 columns text-center marcador"><strong class="show-for-small-only">Marcador: </strong>2 - 0</div>
                <div class="small-4 medium-1 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>10</div>
                <div class="small-4 medium-1 columns canal text-right">
                    <img class="logo" src="assets/img/directv-channel.png" alt="">600dtsc
                </div>
            </div>
            <hr>
            <div class="row columns gutter-small">
                <div class="text-center suma"> Puntaje total de fecha: <strong>100 Puntos</strong></div>
            </div>
            <hr>
            <hr class="light">
            <div class="text-center"><a href="#" class="button large">Guardar pronósticos</a></div>
        </div>
    </div>
@endsection
