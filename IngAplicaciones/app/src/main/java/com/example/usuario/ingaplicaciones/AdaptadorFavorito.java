package com.example.usuario.ingaplicaciones;

import android.content.Context;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by Usuario on 19/11/2017.
 */

public class AdaptadorFavorito extends BaseAdapter {
    //private Button boton_eliminar;
    private Context contexto;
    private ArrayList<EntidadEvento> listaEventos;
    private EntidadEvento item;
    private int DNI;
    //private layout LayoutActual;
    public AdaptadorFavorito(Context contexto, ArrayList<EntidadEvento> listaEventos, int DNI){
        this.contexto=contexto;
        this.listaEventos = listaEventos;
        this.DNI = DNI;
    }
    @Override
    public int getCount() {
        return listaEventos.size();
    }

    @Override
    public Object getItem(int i) {
        return listaEventos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        item = (EntidadEvento) getItem(i);
        view = LayoutInflater.from(contexto).inflate(R.layout.itemfavorito,null);
        //view = LayoutInflater.from(contexto).inflate(R.layout.layoutPasadoAlConstructor,null);
        TextView tv_nombre = (TextView) view.findViewById(R.id.textV_nombre);
        TextView tv_lugar = (TextView) view.findViewById(R.id.textV_lugar);
        TextView tv_horario = (TextView) view.findViewById(R.id.textV_horario);
        TextView tv_expositor = (TextView) view.findViewById(R.id.textV_expositor);
        tv_nombre.setText(listaEventos.get(i).getNombre());
        tv_lugar.setText(listaEventos.get(i).getLugar());
        tv_horario.setText(listaEventos.get(i).getHorario());
        String aux = listaEventos.get(i).getNombre_Expositor() +" "+listaEventos.get(i).getApellido_Expositor();
        tv_expositor.setText(aux);
       /* boton_eliminar = (Button) view.findViewById(R.id.boton_eliminar);
        boton_eliminar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boton_eliminar.setEnabled(false);
                eliminarFavorito();

            }
        });*/
        return view;
    }
    protected void eliminarFavorito(){
        Response.Listener<String> respuestaListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                try {
                    JSONObject respuestaJSON = new JSONObject(response);
                    boolean consultaExitosa = respuestaJSON.getBoolean("consultaExitosa");
                    if(!consultaExitosa){
                        AlertDialog.Builder builder = new AlertDialog.Builder(contexto);
                        builder.setMessage("error en eliminar como favorito un evento")
                                .setNegativeButton("Retry",null)
                                .create().show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };

        EliminarFavoritoRequest pedido = new EliminarFavoritoRequest(item.getId(),DNI,respuestaListener);
        RequestQueue queue = Volley.newRequestQueue(contexto);
        queue.add(pedido);
    }
}
