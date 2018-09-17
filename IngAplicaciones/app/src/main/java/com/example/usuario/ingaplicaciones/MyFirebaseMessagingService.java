package com.example.usuario.ingaplicaciones;

import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;

import android.content.Context;
import android.content.Intent;

import android.media.RingtoneManager;
import android.net.Uri;

import android.os.Build;
import android.support.v4.app.NotificationCompat;
import android.util.Log;

import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

import java.util.Map;

/**
 * Created by Usuario on 5/12/2017.
 */

public class MyFirebaseMessagingService extends FirebaseMessagingService {
    private NotificationManager notifManager;
    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {
        super.onMessageReceived(remoteMessage);


        Log.d("MyFirebaseMessaging: ", "From: " + remoteMessage.getFrom());

        // Check if message contains a data payload.
        if (remoteMessage.getData().size() > 0) {
            Log.d("MyFirebaseMessaging: ", "Message data payload: " + remoteMessage.getData());
            Map<String, String> datos = remoteMessage.getData();
            String titulo = datos.get("titulo");
            Log.d("MyFirebaseMessaging: ", "Message data titulo: " + titulo);
            String contenido = datos.get("contenido");
            String subtexto = datos.get("subtexto");
            sendNotification(titulo,contenido,subtexto);
        }

        // Check if message contains a notification payload.
        if (remoteMessage.getNotification() != null) {
            Log.d("MyFirebaseMessaging: ", "Message Notification Body: " + remoteMessage.getNotification().getBody());
        }


    }
    //al aprecer segun la documentacion se usa este metodo nomas cuando estamos en el foreground, osea con la aplicacion
    //prendida, de otro modo no pasa nada.
    private void sendNotification(String titulo, String contenido, String subtexto) {
        final int NOTIFY_ID = 1002;

        // There are hardcoding only for show it's just strings
        String name = "my_package_channel";
        String id = getString(R.string.default_notification_channel_id); // The user-visible name of the channel.
        String description = "my_package_first_channel"; // The user-visible description of the channel.

        Intent intent;
        PendingIntent pendingIntent;
        NotificationCompat.Builder builder;

        if (notifManager == null) {
            notifManager =
                    (NotificationManager)getSystemService(Context.NOTIFICATION_SERVICE);
        }
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            int importance = NotificationManager.IMPORTANCE_HIGH;
            NotificationChannel mChannel = new NotificationChannel(id, name, importance);
            mChannel.setDescription(description);
            mChannel.enableVibration(true);
            mChannel.setVibrationPattern(new long[]{100, 200, 300, 400, 500, 400, 300, 200, 400});
            notifManager.createNotificationChannel(mChannel);

            builder = new NotificationCompat.Builder(this, id);

            intent = new Intent(this, RecepcionNotificacion.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
            intent.putExtra("titulo",titulo);
            intent.putExtra("contenido",contenido);
            intent.putExtra("subtexto",subtexto);
            pendingIntent = PendingIntent.getActivity(this, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);

            Uri defaultSoundUri= RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
            builder.setContentTitle(titulo)  // required
                    //.setSmallIcon(android.R.drawable.ic_popup_reminder) // required
                    .setSmallIcon(R.drawable.ic_stat_ic_notification)
                    .setContentText(contenido)  // required
                    .setDefaults(Notification.DEFAULT_ALL)
                    .setSubText(subtexto)
                    .setSound(defaultSoundUri)
                    .setAutoCancel(true)
                    .setContentIntent(pendingIntent)
                    .setVibrate(new long[]{100, 200, 300, 400, 500, 400, 300, 200, 400});

        } else {

            builder = new NotificationCompat.Builder(this);

            intent = new Intent(this, RecepcionNotificacion.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
            intent.putExtra("titulo",titulo);
            intent.putExtra("contenido",contenido);
            intent.putExtra("subtexto",subtexto);
            pendingIntent = PendingIntent.getActivity(this, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);

            Uri defaultSoundUri= RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
            builder.setContentTitle(titulo)                           // required
                    .setSmallIcon(R.drawable.ic_stat_ic_notification)
                    .setContentText(contenido)  // required
                    .setDefaults(Notification.DEFAULT_ALL)
                    .setSubText(subtexto)
                    .setSound(defaultSoundUri)
                    .setAutoCancel(true)
                    .setContentIntent(pendingIntent)
                    .setVibrate(new long[]{100, 200, 300, 400, 500, 400, 300, 200, 400})
                    .setPriority(Notification.PRIORITY_HIGH);
        } // else if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {

        Notification notification = builder.build();
        notifManager.notify(NOTIFY_ID, notification);
    }
}
