package com.example.user.upcyclothes;

import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.app.Fragment;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by jinhee on 2018-10-11.
 */

public class BagActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    String[] p_id_list;
    String[] p_name_list;
    String[] p_designer_list;
    String[] p_price_list;
    String[] p_url_list;
    String[] p_detailUrl_list;
    String[] p_quantity_list;
    private String userID;
    //static ArrayList<String> sauce_list = new ArrayList<>();
    //private Integer[] mThumbIds;

    DisplayMetrics mMetrics;
    View v;
    public BagActivity(){
        LetsConnect c = new LetsConnect();
        c.getItemInfo();

    }

    private GridView.OnItemClickListener gridviewOnItemClickListener
            = new GridView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
            Intent intent = new Intent(BagActivity.this, DetailActivity.class);

            intent.putExtra("category","accessory");
            intent.putExtra("item id",p_id_list[arg2]);
            intent.putExtra("item name",p_name_list[arg2]);
            intent.putExtra("designer",p_designer_list[arg2]);
            intent.putExtra("item price",p_price_list[arg2]);
            intent.putExtra("item url",p_url_list[arg2]);
            intent.putExtra("item detail url",p_detailUrl_list[arg2]);
            intent.putExtra("item quantity", p_quantity_list[arg2]);
            startActivity(intent);
        }
    };
    @Override

    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bag);
        userID=MainActivity.userID;
        GridView gridview = (GridView) findViewById(R.id.gridview);

        GridAdapter adapter= new GridAdapter(this,p_name_list,p_price_list,p_url_list);
        gridview.setAdapter(adapter);

        gridview.setOnItemClickListener(gridviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        getWindowManager().getDefaultDisplay().getMetrics(mMetrics);

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

                if(userID==null) {
                    Intent intent = new Intent(BagActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(BagActivity.this, MypageActivity.class);
                    startActivity(intent);
                }
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(userID==null) {
                    Intent intent = new Intent(BagActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(BagActivity.this, MycartActivity.class);
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
                    Log.v("가방","in");
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
            Intent intent = new Intent(BagActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(BagActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {

            Toast.makeText(this,"현재페이지입니다." ,Toast.LENGTH_LONG).show();

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(BagActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(BagActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(BagActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(BagActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(BagActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(BagActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(BagActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/imageInfo.php", "category=2",false);

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

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    p_name_list=new String[Integer.parseInt(num)];
                    p_id_list=new String[Integer.parseInt(num)];
                    p_designer_list=new String[Integer.parseInt(num)];
                    p_price_list=new String[Integer.parseInt(num)];
                    p_url_list=new String[Integer.parseInt(num)];
                    p_detailUrl_list=new String[Integer.parseInt(num)];
                    p_quantity_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        p_id_list[i]=jo.getString("productID");
                        p_name_list[i]=jo.getString("productName");
                        p_designer_list[i]=jo.getString("designer");
                        p_price_list[i]=jo.getString("price");
                        p_url_list[i]="https://upcyclothes.duckdns.org/android"+jo.getString("URL");
                        p_detailUrl_list[i]="https://upcyclothes.duckdns.org/android"+jo.getString("content");
                        p_quantity_list[i]=jo.getString("quantity");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }


}
