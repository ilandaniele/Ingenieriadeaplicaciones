package com.example.usuario.ingaplicaciones;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.google.firebase.messaging.FirebaseMessaging;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class FavoritoSeleccionadoActivity extends Activity {

    TextView nombre, expositor, detalle, lugar, fecha, horario, cantAsistentes;
    Boolean es_admin;
    Button modificarEvento, verCantAsistentes, boton_eliminar, boton_notificaciones;
    EntidadEvento obj;
    private int DNI,idioma;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_favorito_seleccionado);

        nombre = (TextView) findViewById(R.id.textView_nombreEvento);
        lugar = (TextView) findViewById(R.id.textView_lugar);
        expositor = (TextView) findViewById(R.id.textView_nombreExpositor);
        detalle = (TextView) findViewById(R.id.textView_detalle);
        horario = (TextView) findViewById(R.id.textView_horario);
        fecha = (TextView) findViewById(R.id.textView_fecha);

        modificarEvento = (Button) findViewById(R.id.boton_modificarEvento);
        verCantAsistentes = (Button) findViewById(R.id.boton_verAsistentes);
        cantAsistentes = (TextView) findViewById(R.id.tv_cantAsistentes);
        cantAsistentes.setText("");
        boton_eliminar = (Button) findViewById(R.id.boton_eliminar);
        boton_notificaciones = (Button) findViewById(R.id.boton_notificaciones);

        if(getIntent().getExtras() != null) {
            obj = (EntidadEvento) getIntent().getExtras().getSerializable("objeto");
            DNI = (int) getIntent().getExtras().getSerializable("dni");
            es_admin = (boolean) getIntent().getBooleanExtra("es_admin", false); //por default va false
            idioma = (int) getIntent().getExtras().getSerializable("idioma");
        }

        if(es_admin){
            modificarEvento.setVisibility(View.VISIBLE);
            verCantAsistentes.setVisibility(View.VISIBLE);
        }



        nombre.setText(obj.getNombre());
        String aux = "Lugar a ser realizado: "+obj.getInstitucion()+" "+obj.getLugar() +" aula "+obj.getAula();
        lugar.setText(aux);
        aux=obj.getCargo() + " "+obj.getNombre_Expositor() + " " + obj.getApellido_Expositor();
        expositor.setText(aux);
        detalle.setText(obj.getDetalle());
        fecha.setText(obj.getFecha());
        aux=obj.getHora_inicio()+" - "+obj.getHora_fin();
        horario.setText(aux);

        verCantAsistentes.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                obtenerCantidadAsistentes();
            }
        });
        modificarEvento.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                modificarEvento();
            }
        });
        boton_eliminar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boton_eliminar.setEnabled(false);
                eliminarFavorito();

            }
        });
        boton_notificaciones.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(boton_notificaciones.getText().toString().contentEquals("Desactivar notificaciones")){
                    boton_notificaciones.setText("Activar notificaciones");
                    String nombreSubscripcion = nombre.getText().toString();
                    FirebaseMessaging.getInstance().unsubscribeFromTopic(nombreSubscripcion);
                }else{
                    if(boton_notificaciones.getText().toString().contentEquals("Activar notificaciones")){
                        boton_notificaciones.setText("Desactivar notificaciones");
                        String nombreSubscripcion = nombre.getText().toString();
                        FirebaseMessaging.getInstance().subscribeToTopic(nombreSubscripcion);
                    }
                }
            }
        });


    }


    protected void eliminarFavorito(){
        String nombreSubscripcion = nombre.getText().toString();
        FirebaseMessaging.getInstance().unsubscribeFromTopic(nombreSubscripcion);
        Response.Listener<String> respuestaListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {
                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");
                    if(!consultaExitosa){
                        AlertDialog.Builder builder = new AlertDialog.Builder(FavoritoSeleccionadoActivity.this);
                        builder.setMessage("error en eliminar como favorito un evento")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };

        EliminarFavoritoRequest pedido = new EliminarFavoritoRequest(obj.getId(),DNI,respuestaListener);
        RequestQueue queue = Volley.newRequestQueue(FavoritoSeleccionadoActivity.this);
        queue.add(pedido);
    }
    protected void modificarEvento(){

        Intent cambiazo = new Intent(this,ModificarEventoActivity.class);
        cambiazo.putExtra("objeto", (Serializable) obj);
        cambiazo.putExtra("idioma", (Serializable) idioma);
        startActivity(cambiazo);
    }
    protected void obtenerCantidadAsistentes(){
        Response.Listener<String> respuestaListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {
                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");
                    if(consultaExitosa){
                        int cantidad = respuestaJSON.getInt("cantidad");
                        cantAsistentes.setText("Cantidad de interesados: "+cantidad+"");


                    }else{
                        AlertDialog.Builder builder = new AlertDialog.Builder(FavoritoSeleccionadoActivity.this);
                        builder.setMessage("error en ver la cantidad de asistentes")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };

        VerAsistentesRequest pedido = new VerAsistentesRequest(obj.getId(),respuestaListener);
        RequestQueue queue = Volley.newRequestQueue(FavoritoSeleccionadoActivity.this);
        queue.add(pedido);
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        outState.putInt("dni",DNI);
        outState.putInt("idioma",idioma);
        outState.putBoolean("es_admin",es_admin);
        super.onSaveInstanceState(outState);
    }

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);
        DNI = savedInstanceState.getInt("dni");
        idioma = savedInstanceState.getInt("idioma");
        es_admin = savedInstanceState.getBoolean("es_admin");
    }

    @Override
    protected void onResume() {
        super.onResume();

        obtenerEventoRefrescado();


    }
    private void obtenerEventoRefrescado(){

        Response.Listener<String> respoListener = new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                try {

                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");

                    if (consultaExitosa) {
                        JSONArray resultado = respuestaJSON.getJSONArray("filas");
                        for (int i = 0; i < resultado.length(); i++) {
                            //Como cada elemento del array está en JSON,
                            //obtenemos el objeto JSON correspondiente
                            JSONObject objeto = resultado.getJSONObject(i);
                            //Obtenemos los datos del susodicho
                            if(obj.getId() == objeto.getInt("id")) {
                                obj = new EntidadEvento(objeto.getInt("id"), objeto.getString("nombre"), objeto.getString("lugar")
                                        , objeto.getString("fecha"), objeto.getString("detalle"), objeto.getString("nombre_usuario")
                                        , objeto.getString("apellido"), objeto.getString("aula"), objeto.getString("institucion"), objeto.getString("cargo")
                                        , objeto.getString("horainicio"), objeto.getString("horafin"));
                                nombre.setText(obj.getNombre());
                                String aux = "Lugar a ser realizado: "+obj.getInstitucion()+" "+obj.getLugar() +" aula "+obj.getAula();
                                lugar.setText(aux);
                                aux=obj.getCargo() + " "+obj.getNombre_Expositor() + " " + obj.getApellido_Expositor();
                                expositor.setText(aux);
                                detalle.setText(obj.getDetalle());
                                fecha.setText(obj.getFecha());
                                aux=obj.getHora_inicio()+" - "+obj.getHora_fin();
                                horario.setText(aux);

                            }

                        }



                    } else {
                        android.app.AlertDialog.Builder builder = new android.app.AlertDialog.Builder(FavoritoSeleccionadoActivity.this);
                        builder.setMessage("error en desplegar eventos")
                                .setNegativeButton("Retry", null)
                                .create().show();
                    }

                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }
        };

        EventoRequest eventosRequest = new EventoRequest(idioma, respoListener);
        /* clase que se encarga de comunicarse con volley */
        RequestQueue queue = Volley.newRequestQueue(FavoritoSeleccionadoActivity.this);
        queue.add(eventosRequest);
    }
}
