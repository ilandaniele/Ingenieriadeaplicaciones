package com.example.usuario.ingaplicaciones;

import android.app.Service;
import android.support.v7.app.AlertDialog;
import android.util.Log;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.FirebaseInstanceIdService;
import com.google.firebase.messaging.FirebaseMessaging;


import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Usuario on 5/12/2017.
 */

public class MyFirebaseInstanceIDService extends FirebaseInstanceIdService {
    private static final String TAG = "MyFirebaseIIDService";

    /**
     * Called if InstanceID token is updated. This may occur if the security of
     * the previous token had been compromised. Note that this is called when the InstanceID token
     * is initially generated so this is where you would retrieve the token.
     * Solo es llamado pocas veces, como cuando por ejemplo inicializamos la aplicacion
     * En caso de que tiremos la bd abajo, tenemos que reinstalar el apk para que el token se guarde de nuevo

     */
    //PROBLEMA, EL APNS DEJA DE FUNCIONAR LUEGO DE UN CIERTO TIEMPO
    @Override
    public void onTokenRefresh() {
        String token = FirebaseInstanceId.getInstance().getToken();
        Log.d(TAG, "Refreshed token: " + token);
        //aca debo mandar este token obtenido a la BD
        if(null != token) {
            FirebaseMessaging.getInstance().subscribeToTopic("all"); //esto no se si es necesario, lo uso para probar nomas si andan luego de un tiempo
        }
        enviarTokenALaBD(token);
    }

    //podria aca en vez de enviarlo a la bd, no hacer nada, y directametne tomar en la pagina "inicio"
    //el token cuando inicializa, entonces ahi llamo a aviso request y le guardo con el dni del usuario el token, asi tengo cada usuario
    //que token le pertenece
    private void enviarTokenALaBD(String token) {
        //aca implemento para enviar el token a una tabla de la bd

        Response.Listener<String> respuestaListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {
                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");
                    if(!consultaExitosa){
                        AlertDialog.Builder builder = new AlertDialog.Builder(MyFirebaseInstanceIDService.this);
                        builder.setMessage("error enviar token")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };

        AgregarTokenRequest pedido = new AgregarTokenRequest(token,respuestaListener);
        RequestQueue queue = Volley.newRequestQueue(MyFirebaseInstanceIDService.this);
        queue.add(pedido);
    }

}
