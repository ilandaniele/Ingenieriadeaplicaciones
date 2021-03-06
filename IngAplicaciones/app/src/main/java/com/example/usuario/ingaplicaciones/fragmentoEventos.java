package com.example.usuario.ingaplicaciones;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.ArrayList;

/**
 * Created by Usuario on 15/11/2017.
 */

public class fragmentoEventos extends Fragment {
    ListView listViewEventos;
    AdaptadorEvento adaptador;
    View vistaActual;
    ArrayList<EntidadEvento> listaEventos;
    private boolean es_admin;
    //private boolean favoritos;
    private int DNI, idioma;


    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        vistaActual = inflater.inflate(R.layout.eventos, container, false);
        //favoritos = false; //lo creo unicamente una vez, para el boton de favoritos
        //para obtener el DNI de la PRINCIPAL, la cual lo obtiene del login

        /**
         * Problema raro aqui, cuando seleccionas un evento, al entrar a la ventana evento seleccionao se queda con el evento anterior
         * en cuanto a la información de favoritos, y no se sabe por que
         */
        if (getArguments() != null) {
            DNI = getArguments().getInt("dni");
            es_admin = getArguments().getBoolean("es_admin");
            idioma = getArguments().getInt("idioma");
            Toast.makeText(getContext(), "El dni es: " + DNI, Toast.LENGTH_SHORT).show();
        }
        return vistaActual;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        if (idioma == 1) {
            getActivity().setTitle("Eventos");
        } else {
            if (idioma == 2) {
                getActivity().setTitle("Events");
            } else {
                getActivity().setTitle("Événements");
            }
        }


        listViewEventos = (ListView) getActivity().findViewById(R.id.ListV_listaEventos);

        listViewEventos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {


                EntidadEvento obj = (EntidadEvento) adapterView.getItemAtPosition(i);

                Intent cambiazo = new Intent(getContext(), EventoSeleccionadoActivity.class);
                cambiazo.putExtra("objeto", (Serializable) obj);
                cambiazo.putExtra("dni", (Serializable) DNI);
                cambiazo.putExtra("es_admin", (Serializable) es_admin);
                cambiazo.putExtra("idioma",idioma);
                startActivity(cambiazo);
            }
        });


    }

    @Override
    public void onSaveInstanceState(Bundle outState) {
        outState.putInt("dni",DNI);
        outState.putInt("idioma",idioma);
        outState.putBoolean("es_admin",es_admin);
        super.onSaveInstanceState(outState);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        if (savedInstanceState != null) {
            DNI = savedInstanceState.getInt("dni", 0);
            idioma = savedInstanceState.getInt("idioma", 1);
            es_admin =  savedInstanceState.getBoolean("es_admin", false);
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        if (getArguments() != null) {
            DNI = getArguments().getInt("dni");
            es_admin = getArguments().getBoolean("es_admin");
            idioma = getArguments().getInt("idioma");
            Toast.makeText(getContext(), "El dni es: " + DNI, Toast.LENGTH_SHORT).show();
        }
        if (idioma == 1) {
            getActivity().setTitle("Eventos");
        } else {
            if (idioma == 2) {
                getActivity().setTitle("Events");
            } else {
                getActivity().setTitle("Événements");
            }
        }
        listaEventos = new ArrayList<EntidadEvento>();


        /* parte agregada para poder enviar la consulta a la base de datos */
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
                            JSONObject obj = resultado.getJSONObject(i);
                            //Obtenemos los datos del susodicho
                            listaEventos.add(new EntidadEvento(obj.getInt("id"), obj.getString("nombre"), obj.getString("lugar")
                                    , obj.getString("fecha"), obj.getString("detalle"), obj.getString("nombre_usuario")
                                    , obj.getString("apellido"), obj.getString("aula"), obj.getString("institucion"), obj.getString("cargo")
                                    , obj.getString("horainicio"), obj.getString("horafin")));


                        }
                        adaptador = new AdaptadorEvento(getActivity(), listaEventos);
                        listViewEventos.setAdapter(adaptador);
                        //lo que sigue es el oyente para cuando presiono un evento


                    } else {
                        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
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
        RequestQueue queue = Volley.newRequestQueue(getActivity());
        queue.add(eventosRequest);
    }
}
