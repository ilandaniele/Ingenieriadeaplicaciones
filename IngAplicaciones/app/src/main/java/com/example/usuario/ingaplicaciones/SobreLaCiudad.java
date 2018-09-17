package com.example.usuario.ingaplicaciones;

import android.app.AlertDialog;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Usuario on 15/11/2017.
 */

public class SobreLaCiudad extends Fragment {
    TextView nombre,info,codPostal;
    View vistaActual;
    private int DNI,idioma;
    private boolean es_admin;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        vistaActual = inflater.inflate(R.layout.sobrelaciudad, container, false);
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
        getActivity().setTitle("Sobre la Ciudad");

        nombre = (TextView) getActivity().findViewById(R.id.nombreCiudad);
        info = (TextView) getActivity().findViewById(R.id.info);
        codPostal = (TextView) getActivity().findViewById(R.id.codPostal);


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
                            info.setText(obj.getString("inf_turistica"));
                            nombre.setText(obj.getString("nombre"));
                            codPostal.setText("Código postal: "+obj.getString("cod_postal"));
                        }


                    } else {
                        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
                        builder.setMessage("error en consultar por la ciudad")
                                .setNegativeButton("Retry", null)
                                .create().show();
                    }

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };


        /* clase que se encarga de comunicarse con volley */
        CiudadRequest ciudadRequest= new CiudadRequest(idioma,respoListener);
        RequestQueue queue = Volley.newRequestQueue(getActivity());
        queue.add(ciudadRequest);

    }
}
