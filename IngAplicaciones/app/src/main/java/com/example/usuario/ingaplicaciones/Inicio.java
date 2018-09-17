package com.example.usuario.ingaplicaciones;

import android.app.AlertDialog;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

/**
 * Created by Usuario on 15/11/2017.
 */

public class Inicio extends Fragment {
    View vistaActual;
    Button crearAviso, enviar;
    TextView titulo, textoDeContenido,subTexto,tipoAviso;
    EditText tituloEdit, textoDeContenidoEdit, subTextoEdit, tipoAvisoEdit;
    private boolean es_admin;
    private int DNI,idioma;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        vistaActual = inflater.inflate(R.layout.inicio, container, false);
        if(getArguments() != null){
            DNI = getArguments().getInt("dni");
            es_admin = getArguments().getBoolean("es_admin");
            Toast.makeText(getContext(),"El dni es: "+DNI,Toast.LENGTH_SHORT).show();
            idioma = getArguments().getInt("idioma");
        }

        Log.d("Token: ","Instante ID token: " +FirebaseInstanceId.getInstance().getToken());
        FirebaseMessaging.getInstance().subscribeToTopic("all");

        return vistaActual;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        crearAviso = (Button) getActivity().findViewById(R.id.boton_notificacion);
        enviar = (Button) getActivity().findViewById(R.id.boton_enviar);
        tituloEdit = (EditText) getActivity().findViewById(R.id.editT_contentTitle);
        textoDeContenidoEdit = (EditText) getActivity().findViewById(R.id.editT_contentText);
        subTextoEdit = (EditText) getActivity().findViewById(R.id.editT_subText);
        titulo = (TextView) getActivity().findViewById(R.id.text_titulo);
        textoDeContenido = (TextView) getActivity().findViewById(R.id.text_contenido);
        subTexto = (TextView) getActivity().findViewById(R.id.text_subText);
        tipoAviso = (TextView) getActivity().findViewById(R.id.text_tipoAviso);
        tipoAvisoEdit = (EditText) getActivity().findViewById(R.id.editT_tipoAviso);

        if(es_admin){
            crearAviso.setVisibility(View.VISIBLE);
        }
        if(idioma == 1){
            getActivity().setTitle("Inicio");
            crearAviso.setText("Crear aviso");
        }else{
            if(idioma == 2){
                getActivity().setTitle("Main");
                crearAviso.setText("Make an announcement");
            }else{
                if(idioma == 3){
                    getActivity().setTitle("Accueil");
                    crearAviso.setText("faire une annonce");
                }else{
                    //si por alguna razon no llega el parametro idioma
                    getActivity().setTitle("Inicio");
                    crearAviso.setText("Crear aviso");
                }
            }
        }
        crearAviso.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                enviar.setVisibility(View.VISIBLE);
                tituloEdit.setVisibility(View.VISIBLE);
                textoDeContenidoEdit.setVisibility(View.VISIBLE);
                subTextoEdit.setVisibility(View.VISIBLE);
                titulo.setVisibility(View.VISIBLE);
                textoDeContenido.setVisibility(View.VISIBLE);
                subTexto.setVisibility(View.VISIBLE);
                tipoAviso.setVisibility(View.VISIBLE);
                tipoAvisoEdit.setVisibility(View.VISIBLE);
            }
        });
        enviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String tAviso = tipoAvisoEdit.getText().toString();
                String titulo = tituloEdit.getText().toString();
                String texto = textoDeContenidoEdit.getText().toString();
                String subtexto = subTextoEdit.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>(){
                    @Override
                    public void onResponse(String response) {

                    }
                };

                AvisoRequest request = new AvisoRequest(tAviso,titulo,texto,subtexto,  responseListener);
                // clase que se encarga de comunicarse con volley
                RequestQueue queue = Volley.newRequestQueue(getActivity());
                queue.add(request);
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
        FirebaseInstanceId.getInstance().getToken();
        FirebaseMessaging.getInstance().subscribeToTopic("all");
        if(getArguments() != null){
            DNI = getArguments().getInt("dni");
            es_admin = getArguments().getBoolean("es_admin");
            Toast.makeText(getContext(),"El dni es: "+DNI,Toast.LENGTH_SHORT).show();
            idioma = getArguments().getInt("idioma");
        }
        if(es_admin){
            crearAviso.setVisibility(View.VISIBLE);
        }
        if(idioma == 1){
            getActivity().setTitle("Inicio");
            crearAviso.setText("Crear aviso");
        }else{
            if(idioma == 2){
                getActivity().setTitle("Main");
                crearAviso.setText("Make an announcement");
            }else{
                if(idioma == 3){
                    getActivity().setTitle("Accueil");
                    crearAviso.setText("faire une annonce");
                }else{
                    //si por alguna razon no llega el parametro idioma
                    getActivity().setTitle("Inicio");
                    crearAviso.setText("Crear aviso");
                }
            }
        }
    }
}
