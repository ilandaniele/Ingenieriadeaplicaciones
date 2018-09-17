package com.example.usuario.ingaplicaciones;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Usuario on 19/11/2017.
 */

public class AdaptadorExpositor extends BaseAdapter {

    private Context contexto;
    private ArrayList<EntidadExpositor> listaExpositores;

    public AdaptadorExpositor(Context contexto, ArrayList<EntidadExpositor> listaExpositores){
        this.contexto=contexto;
        this.listaExpositores = listaExpositores;
    }
    @Override
    public int getCount() {
        return listaExpositores.size();
    }

    @Override
    public Object getItem(int i) {
        return listaExpositores.get(i);
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        EntidadExpositor item = (EntidadExpositor) getItem(i);
        view = LayoutInflater.from(contexto).inflate(R.layout.itemexpositor,null);
        TextView tv_nombreyapellido = (TextView) view.findViewById(R.id.textV_nombreyapellido);
        TextView tv_cargoeinstitucion = (TextView) view.findViewById(R.id.textV_cargoeinstitucion);
        String aux=listaExpositores.get(i).getNombre() +  " " +listaExpositores.get(i).getApellido();
        tv_nombreyapellido.setText(aux);
        aux=listaExpositores.get(i).getCargo() + " en " + listaExpositores.get(i).getInstitucion();
        tv_cargoeinstitucion.setText(aux);

        return view;
    }
}
