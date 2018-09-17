package com.example.usuario.ingaplicaciones;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class ExpositorSeleccionadoActivity extends Activity {

    TextView nombreyapellido, cargoeinstitucion,biografia;
    EntidadExpositor obj;
    private int idioma;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_expositor_seleccionado);

        nombreyapellido = (TextView) findViewById(R.id.textView_nombreyapellido);
        cargoeinstitucion = (TextView) findViewById(R.id.textView_cargoeinstitucion);
        biografia = (TextView) findViewById(R.id.textView_biografia);
        if(getIntent().getExtras() != null){
            obj = (EntidadExpositor) getIntent().getExtras().getSerializable("objeto");
            idioma = (int) getIntent().getExtras().getSerializable("idioma");
        }

        String aux = obj.getNombre() + " " + obj.getApellido();
        nombreyapellido.setText(aux);
        aux = obj.getCargo()+ " en "+obj.getInstitucion();
        cargoeinstitucion.setText(aux);
        biografia.setText(obj.getBiografia());

    }

    @Override
    protected void onResume() {
        super.onResume();

        obtenerExpositorRefrescado();
        //lo que esta debajo de esta funcion, se ejecuta antes de hacer la request a volley, pareciera que la request
        //se hace al final, por lo tanto hay que hacer las cosas en el listener.

    }
    private void obtenerExpositorRefrescado(){

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
                            if(obj.getDNI() == objeto.getInt("dni")) {
                                obj = new EntidadExpositor(objeto.getInt("dni"),objeto.getString("nombre_usuario"),objeto.getString("apellido")
                                        ,objeto.getString("institucion"),objeto.getString("cargo"),objeto.getString("biografia"));
                                String aux = obj.getNombre() + " " + obj.getApellido();
                                nombreyapellido.setText(aux);
                                aux = obj.getCargo()+ " en "+obj.getInstitucion();
                                cargoeinstitucion.setText(aux);
                                biografia.setText(obj.getBiografia());


                            }

                        }



                    } else {
                        android.app.AlertDialog.Builder builder = new android.app.AlertDialog.Builder(ExpositorSeleccionadoActivity.this);
                        builder.setMessage("error en desplegar eventos")
                                .setNegativeButton("Retry", null)
                                .create().show();
                    }

                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }
        };

        ExpositorRequest expositoresRequest = new ExpositorRequest(idioma, respoListener);
        RequestQueue queue = Volley.newRequestQueue(ExpositorSeleccionadoActivity.this);
        queue.add(expositoresRequest);
    }


}
