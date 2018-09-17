package com.example.usuario.ingaplicaciones;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;

public class Principal extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    private boolean es_admin;
    private int DNI, idioma;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_principal);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        displaySelectedScreen(R.id.nav_inicio);
        if(getIntent().getExtras() != null){
            DNI = (int) getIntent().getExtras().getSerializable("dni");
            es_admin = (boolean) getIntent().getExtras().getSerializable("es_admin");
            idioma = (int) getIntent().getExtras().getSerializable("idioma");
        }

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.principal, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private void displaySelectedScreen(int id){
        Fragment fragment = null; //creo el fragmento que va a aparecer en la pantalla, segun el id pasado por el metodo
                                  //on navigation item selected
        switch(id){
            case R.id.nav_inicio:
                fragment = new Inicio();
                break;
            case R.id.nav_eventos:
                fragment = new fragmentoEventos();
                break;
            case R.id.nav_expositores:
                fragment = new fragmentoExpositores();
                break;
            case R.id.nav_favoritos:
                fragment = new fragmentoFavoritos();
                break;
            case R.id.nav_SobreElCongreso:
                fragment = new SobreElCongreso();
                break;
            case R.id.nav_SobreLaCiudad:
                fragment = new SobreLaCiudad();
                break;
            case R.id.nav_SobreLaApp:
                fragment = new SobreLaApp();
                break;
            case R.id.nav_clima:
                fragment = new Clima();
                break;
        }
        if(fragment != null){
            Bundle bundle = new Bundle();
            bundle.putInt("dni",DNI); //aca hay que poner el dni obtenido del login
            bundle.putBoolean("es_admin",es_admin);
            bundle.putInt("idioma",idioma);
            fragment.setArguments(bundle);
            FragmentTransaction ft = getSupportFragmentManager().beginTransaction();
            ft.replace(R.id.content_principal,fragment);
            ft.commit();
        }
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
    }
    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        displaySelectedScreen(id);
        return true;
    }
    //guardo el estado actual, para que si queda en background o para atras, pueda recuperar el estado
    @Override
    public void onSaveInstanceState(Bundle outState) {
        outState.putInt("dni",DNI);
        outState.putInt("idioma",idioma);
        outState.putBoolean("es_admin",es_admin);
        super.onSaveInstanceState(outState);
    }
    //este metodo es llamado cuando quiero recuperar la actividad

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);
        DNI = savedInstanceState.getInt("dni");
        idioma = savedInstanceState.getInt("idioma");
        es_admin = savedInstanceState.getBoolean("es_admin");
    }

    @Override
    protected void onResume() {
        super.onResume();
        if(getIntent().getExtras() != null){
            DNI = (int) getIntent().getExtras().getSerializable("dni");
            es_admin = (boolean) getIntent().getExtras().getSerializable("es_admin");
            idioma = (int) getIntent().getExtras().getSerializable("idioma");
        }
    }
}
