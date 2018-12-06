package com.example.user.upcyclothes;

import android.content.Intent;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MaterialActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    String[] m_id_list;
    String[] m_name_list;
    String[] m_url_list;
    String[] remain_amount_list;
    DisplayMetrics mMetrics;
    View v;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_material);
        LetsConnect c = new LetsConnect();
        c.getItemInfo();
        //이미지 다 받으면

        GridView gridview = (GridView)findViewById(R.id.gridview);
        GridView.OnItemClickListener gridviewOnItemClickListener
                = new GridView.OnItemClickListener() {

            public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                    long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
                Intent intent = new Intent(MaterialActivity.this, DetailMaterial.class);
                intent.putExtra("type",true);
                intent.putExtra("item id",m_id_list[arg2]);
                intent.putExtra("item name",m_name_list[arg2]);
                intent.putExtra("item url",m_url_list[arg2]);
                intent.putExtra("item remain amount",remain_amount_list[arg2]);
                startActivity(intent);
            }
        };


        GridAdapter adapter= new GridAdapter(this,m_name_list,m_url_list);
        gridview.setAdapter(adapter);

        gridview.setOnItemClickListener(gridviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        toggle.getDrawerArrowDrawable().setColor(getColor(R.color.colorMain));

        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);


        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(MaterialActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(MaterialActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(MaterialActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(MaterialActivity.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 2000:
                    Log.v("악세서리","in");
                    break;
            }
        }
    }

    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_new) {
            // Handle the camera action
            Intent intent = new Intent(MaterialActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(MaterialActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(MaterialActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(MaterialActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(MaterialActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(MaterialActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {

            Toast.makeText(this,"현재페이지입니다." ,Toast.LENGTH_LONG).show();
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(MaterialActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(MaterialActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(MaterialActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/MaterialInfo.php", "category=0",false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 재고아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    m_id_list=new String[Integer.parseInt(num)];
                    m_name_list=new String[Integer.parseInt(num)];
                    m_url_list=new String[Integer.parseInt(num)];
                    remain_amount_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        m_id_list[i]=jo.getString("materialID");
                        m_name_list[i]=jo.getString("materialName");
                        m_url_list[i]="https://upcyclothes.duckdns.org"+jo.getString("URL");
                        remain_amount_list[i]=jo.getString("material_Quantity");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
