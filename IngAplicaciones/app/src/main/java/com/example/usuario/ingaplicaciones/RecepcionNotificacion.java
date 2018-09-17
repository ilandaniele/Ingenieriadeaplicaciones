package com.example.usuario.ingaplicaciones;

import android.app.Activity;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.io.Serializable;

/**
 * Created by Usuario on 5/12/2017.
 */

public class RecepcionNotificacion extends Activity{
//aqui recibimos todos los intents de la notificación, y luego ponemos abajo el boton de login para poder ir a
    //el inicio de la app

    TextView titulo, contenido, subtexto;
    Button login;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recepcionnotificacion);
        login = (Button) findViewById(R.id.boton_login);
        titulo = (TextView) findViewById(R.id.textV_titulo);
        contenido = (TextView) findViewById(R.id.textV_contenido);
        subtexto = (TextView) findViewById(R.id.textV_subtexto);
        //creo que se utiliza cuando estamos en el foreground
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            // Create channel to show notifications.
            String channelId  = getString(R.string.default_notification_channel_id);
            String channelName = getString(R.string.default_notification_channel_name);
            NotificationManager notificationManager =
                    getSystemService(NotificationManager.class);
            notificationManager.createNotificationChannel(new NotificationChannel(channelId,
                    channelName, NotificationManager.IMPORTANCE_LOW));
        }

        //para el foreground, ver el video del español
        if(getIntent().getExtras() != null){
            titulo.setText(getIntent().getStringExtra("titulo"));
            contenido.setText(getIntent().getStringExtra("contenido"));
            subtexto.setText(getIntent().getStringExtra("subtexto"));
        }
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent cambio= new Intent(RecepcionNotificacion.this,Login.class);
                startActivity(cambio);
                finish();
            }
        });

    }
}
