package com.example.usuario.ingaplicaciones;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.preference.EditTextPreference;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class ModificarEventoActivity extends Activity {

    EditText nombre, expositor, detalle, lugar, fecha, horainicio, horafin, aula;
    //Boolean es_admin;
    Button enviar;
    EntidadEvento obj;
    private int idioma;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_modificar_evento);

        nombre = (EditText) findViewById(R.id.EditText_nombreEvento);
        lugar = (EditText) findViewById(R.id.EditText_lugar);
        detalle = (EditText) findViewById(R.id.EditText_detalle);
        horainicio = (EditText) findViewById(R.id.EditText_horainicio);
        horafin= (EditText) findViewById(R.id.EditText_horafin);
        fecha = (EditText) findViewById(R.id.EditText_fecha);
        aula = (EditText) findViewById(R.id.EditText_aula);

        enviar = (Button) findViewById(R.id.boton_enviar);

        if(getIntent().getExtras() != null) {
            obj = (EntidadEvento) getIntent().getExtras().getSerializable("objeto");
            idioma = (int) getIntent().getExtras().getSerializable("idioma");
        }

        obj = (EntidadEvento) getIntent().getExtras().getSerializable("objeto");

        nombre.setText(obj.getNombre());
        lugar.setText(obj.getLugar());
        aula.setText(obj.getAula());
        detalle.setText(obj.getDetalle());
        fecha.setText(obj.getFecha());
        horainicio.setText(obj.getHora_inicio());
        horafin.setText(obj.getHora_fin());
        enviar.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                enviar();
                enviar.setEnabled(false);
            }
        });


    }

    protected void enviar(){
        Response.Listener<String> respoListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {

                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");

                    if(!consultaExitosa){
                        AlertDialog.Builder builder = new AlertDialog.Builder(ModificarEventoActivity.this);
                        builder.setMessage("error en modificar un favorito")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    Log.e("JSON Parser", "Error parsing data [" + e.getMessage()+"] "+response);


                }
            }
        };

        ModificarEventoRequest pedido = new ModificarEventoRequest(idioma,obj.getId(),nombre.getText().toString(),lugar.getText().toString(),detalle.getText().toString(),horainicio.getText().toString(),horafin.getText().toString(),fecha.getText().toString(),aula.getText().toString(),respoListener);
        RequestQueue queue = Volley.newRequestQueue(ModificarEventoActivity.this);
        queue.add(pedido);
    }




}
