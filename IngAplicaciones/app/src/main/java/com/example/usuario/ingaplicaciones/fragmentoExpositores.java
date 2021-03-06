package com.example.usuario.ingaplicaciones;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
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

public class fragmentoExpositores extends Fragment {
    ListView listViewExpositores;
    AdaptadorExpositor adaptador;
    View vistaActual;
    ArrayList<EntidadExpositor> listaExpositores;
    private int DNI,idioma;
    private boolean es_admin;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        vistaActual = inflater.inflate(R.layout.expositores, container, false);
        if(getArguments() != null){
            DNI = getArguments().getInt("dni");
            es_admin = getArguments().getBoolean("es_admin");
            idioma = getArguments().getInt("idioma");
            Toast.makeText(getContext(),"El dni es: "+DNI,Toast.LENGTH_SHORT).show();
        }
        return vistaActual;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        getActivity().setTitle("Oradores");

        listViewExpositores = (ListView) getActivity().findViewById(R.id.ListV_listaExpositores);
        listaExpositores = new ArrayList<EntidadExpositor>();


        /* parte agregada para poder enviar la consulta a la base de datos */
        Response.Listener<String> respoListener = new Response.Listener<String>(){

            @Override
            public void onResponse(String response) {
                try {

                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");

                    if(consultaExitosa){
                        JSONArray resultado = respuestaJSON.getJSONArray("filas");
                        for (int i = 0; i < resultado.length(); i++) {
                            //Como cada elemento del array está en JSON,
                            //obtenemos el objeto JSON correspondiente
                            JSONObject obj = resultado.getJSONObject(i);
                            //Obtenemos los datos del susodicho
                            listaExpositores.add(new EntidadExpositor(obj.getInt("dni"),obj.getString("nombre_usuario"),obj.getString("apellido")
                                    ,obj.getString("institucion"),obj.getString("cargo"),obj.getString("biografia")));


                        }
                        adaptador = new AdaptadorExpositor(getActivity(),listaExpositores);
                        listViewExpositores.setAdapter(adaptador);
                        //lo que sigue es el oyente para cuando presiono un evento


                    }else{
                        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
                        builder.setMessage("error en desplegar expositores")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }

                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }
        };

        ExpositorRequest expositoresRequest = new ExpositorRequest(idioma,respoListener);
        /* clase que se encarga de comunicarse con volley */
        RequestQueue queue = Volley.newRequestQueue(getActivity());
        queue.add(expositoresRequest);

        listViewExpositores.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                EntidadExpositor obj = (EntidadExpositor) adapterView.getItemAtPosition(i);
                Intent cambiazo = new Intent(getContext(),ExpositorSeleccionadoActivity.class);
                cambiazo.putExtra("objeto", (Serializable) obj);
                cambiazo.putExtra("idioma", (Serializable) idioma);
                startActivity(cambiazo);
            }
        });
    }
    @Override
    public void onSaveInstanceState(Bundle outState) {
        outState.putInt("idioma",idioma);
        super.onSaveInstanceState(outState);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        if (savedInstanceState != null) {
            idioma = savedInstanceState.getInt("idioma", 1);

        }
    }
}
