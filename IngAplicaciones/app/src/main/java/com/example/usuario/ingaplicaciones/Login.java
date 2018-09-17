package com.example.usuario.ingaplicaciones;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class Login extends AppCompatActivity {
    TextView iniciarSesion;
    EditText et_usuario, et_password;
    Button btn_registrar;
    RadioGroup grupo;
    RadioButton español, ingles, frances;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        SharedPreferences prefs =
                getSharedPreferences("MisPreferencias",Context.MODE_PRIVATE);
        String user = prefs.getString("username", null);
        String pass = prefs.getString("password",null);
        if(user != null && pass != null){
            boolean es_admin = prefs.getBoolean("es_admin",false);
            int dni = prefs.getInt("dni",0);
            int idioma = prefs.getInt("idioma",1);
            Intent cambio= new Intent(Login.this,Principal.class);
            cambio.putExtra("es_admin",(Serializable) es_admin);
            cambio.putExtra("dni",(Serializable) dni);
            cambio.putExtra("idioma",(Serializable) idioma);
            startActivity(cambio);
            finish();
        }else{
            et_usuario = (EditText) findViewById(R.id.EditT_usuario);
            et_password = (EditText) findViewById(R.id.EditT_password);
            btn_registrar = findViewById(R.id.Btn_registrar);
            iniciarSesion = findViewById(R.id.text_iniciarsesion);
            grupo = (RadioGroup) findViewById(R.id.radio_grupo);
            español = (RadioButton) findViewById(R.id.español);
            ingles = (RadioButton) findViewById(R.id.ingles);
            frances = (RadioButton) findViewById(R.id.frances);


            grupo.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
                @Override
                public void onCheckedChanged(RadioGroup radioGroup, int i) {
                    if(i == español.getId() ){
                        et_usuario.setHint("Usuario");
                        et_password.setHint("Contraseña");
                        btn_registrar.setText("Iniciar");
                        iniciarSesion.setText("Iniciar sesión");
                        español.setText("Español");
                        ingles.setText("Inglés");
                        frances.setText("Francés");
                    }else{
                        if(i == ingles.getId()){
                            et_usuario.setHint("User");
                            et_password.setHint("password");
                            btn_registrar.setText("Enter");
                            iniciarSesion.setText("Log in");
                            español.setText("Spanish");
                            ingles.setText("English");
                            frances.setText("French");
                        }else{
                            if(i == frances.getId()){
                                et_usuario.setHint("User");
                                et_password.setHint("password");
                                btn_registrar.setText("Entrer");
                                iniciarSesion.setText("Commencer la session");
                                español.setText("Espanol");
                                ingles.setText("Anglais");
                                frances.setText("Français");
                            }
                        }
                    }
                }
            });

            btn_registrar.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    String username=et_usuario.getText().toString();
                    String password=et_password.getText().toString();

                    Response.Listener<String> respoListener = new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jsonReponse = new JSONObject(response);
                                boolean consultaExitosa= jsonReponse.getBoolean("consultaExitosa");
                                if(consultaExitosa){
                                    boolean login= jsonReponse.getBoolean("login");
                                    boolean es_admin = jsonReponse.getBoolean("es_admin");

                                    String nombre_usuario = jsonReponse.getString("nombre_usuario");
                                    String apellido = jsonReponse.getString("apellido");
                                    String username = jsonReponse.getString("username");
                                    String password = jsonReponse.getString("password");
                                    int dni = jsonReponse.getInt("dni");
                                    if(login){



                                        int selectedId = grupo.getCheckedRadioButtonId();
                                        int idioma=1;
                                        if(selectedId == español.getId()) {
                                            idioma=1;
                                        } else if(selectedId == ingles.getId()) {
                                            idioma=2;
                                        } else {
                                            idioma=3;
                                        }
                                        SharedPreferences prefs =
                                                getSharedPreferences("MisPreferencias", Context.MODE_PRIVATE);

                                        SharedPreferences.Editor editor = prefs.edit();
                                        editor.putString("username", username);
                                        editor.putString("password", password);
                                        editor.putBoolean("es_admin", es_admin);
                                        editor.putInt("dni",dni);
                                        editor.putInt("idioma",idioma);
                                        editor.commit();
                                        Intent cambio= new Intent(Login.this,Principal.class);
                                        cambio.putExtra("es_admin",(Serializable) es_admin);
                                        cambio.putExtra("dni",(Serializable) dni);
                                        cambio.putExtra("idioma",(Serializable) idioma);
                                        startActivity(cambio);
                                        finish();
                                    }else{
                                        AlertDialog.Builder builder=new AlertDialog.Builder(Login.this);
                                        builder.setMessage("Contraseña o usuario erróneos")
                                                .setNegativeButton("Retry",null)
                                                .create().show();
                                    }

                                }
                                else{
                                    AlertDialog.Builder builder=new AlertDialog.Builder(Login.this);
                                    builder.setMessage("error registro")
                                            .setNegativeButton("Retry",null)
                                            .create().show();
                                }
                            }catch( JSONException e){
                                e.printStackTrace();
                            }
                        }
                    };

                    LoginRequest registerRequest= new LoginRequest(username,password,respoListener);
                    RequestQueue queue= Volley.newRequestQueue(Login.this);
                    queue.add(registerRequest);
                }
            });
        }


    }
}
