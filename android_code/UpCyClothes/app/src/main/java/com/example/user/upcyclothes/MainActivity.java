package com.example.user.upcyclothes;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.view.ViewPager;
import android.support.v7.app.ActionBar;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ImageView;


import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    static String userID;
    static boolean pushFlag;
    String[] p_id_list;
    String[] p_name_list;
    String[] p_designer_list;
    String[] p_price_list;
    String[] p_url_list;
    String[] p_detailUrl_list;
    String[] p_quantity_list;

    DisplayMetrics mMetrics;
    View v;

    ViewPager viewPager;
    ScrollAdapter s_adapter;
    private boolean sessChk=false;
    private String URL="https://upcyclothes.duckdns.org";

    private String sessID;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //최초 실행 여부 판단하는 구문
        SharedPreferences pref = getSharedPreferences("isFirst", Activity.MODE_PRIVATE);
        boolean first = pref.getBoolean("isFirst", false);
        if(first==false){
            Intent in= new Intent(MainActivity.this,tutorialActivity.class);
            startActivity(in);

            Log.v("Is first Time?", "first");
            SharedPreferences.Editor editor = pref.edit();
            editor.putBoolean("isFirst",true);
            editor.commit();
            android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MainActivity.this);
            android.support.v7.app.AlertDialog dialog = builder.setMessage("푸시 알림을 허용하시겠습니까?").setPositiveButton("YES", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    Log.v("푸시알림인메인", "허용");
                    pushFlag=true;
                }

            })
                    .setNegativeButton("NO", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            Log.v("푸시알림인메인", "비허용");
                            pushFlag=false;
                        }
                    }).create();
            dialog.show();
        }


        LetsConnect c = new LetsConnect();
        c.getItemInfo();

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


        if(sessID!=null){
            Log.v("sessID",sessID);
//
            FirebaseMessaging.getInstance().subscribeToTopic("news");
            FirebaseInstanceId.getInstance().getToken();

            LetsConnect connect = new LetsConnect();
            connect.loggedORNot(URL,sessID);
            //세션유지성공!
            sessChk=true;
        }
        //중간의 슬라이딩 사진
        viewPager = (ViewPager) findViewById(R.id.view);
        s_adapter = new ScrollAdapter(this);
        viewPager.setAdapter(s_adapter);

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
                if(userID==null) {
                    Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                    startActivityForResult(intent,3000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(MainActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                if(userID==null) {
                    Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                    startActivityForResult(intent,3000);
                }
                else {
                    Intent intent = new Intent(MainActivity.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });


        GridView gridview = (GridView)findViewById(R.id.gridview);

        GridAdapter adapter = new GridAdapter(this, p_name_list, p_price_list, p_url_list);
        gridview.setAdapter(adapter);

        gridview.setOnItemClickListener(gridviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        getWindowManager().getDefaultDisplay().getMetrics(mMetrics);



    }
    //그리드뷰 클릭리스너
    private GridView.OnItemClickListener gridviewOnItemClickListener
            = new GridView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
            Intent intent = new Intent(MainActivity.this, DetailActivity.class);

            intent.putExtra("category", "accessory");
            intent.putExtra("item id", p_id_list[arg2]);
            intent.putExtra("item name", p_name_list[arg2]);
            intent.putExtra("designer",p_designer_list[arg2]);
            intent.putExtra("item price", p_price_list[arg2]);
            intent.putExtra("item url", p_url_list[arg2]);
            intent.putExtra("item detail url", p_detailUrl_list[arg2]);
            intent.putExtra("item quantity", p_quantity_list[arg2]);
            startActivity(intent);
        }
    };



    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_new) {
            // Handle the camera action
            Intent intent = new Intent(MainActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(MainActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(MainActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(MainActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(MainActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(MainActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(MainActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(MainActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(MainActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(MainActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 3000:
                    //로그인 결과로 세션아이디 받으면
                    sessID=data.getStringExtra("sessID");
                    break;
            }
        }
    }
    private class LetsConnect {

        protected void loggedORNot(String url,String sessID) {
            URLConnector task = new URLConnector(url,sessID);
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            if(result.equals("OK")){
                return;
            }
        }
        protected void getItemInfo() {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/newInfo.php", "category=0", false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }

        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요", result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num = root.getString("num_results");
                    p_name_list = new String[Integer.parseInt(num)];
                    p_id_list = new String[Integer.parseInt(num)];
                    p_designer_list=new String[Integer.parseInt(num)];
                    p_price_list = new String[Integer.parseInt(num)];
                    p_url_list = new String[Integer.parseInt(num)];
                    p_detailUrl_list = new String[Integer.parseInt(num)];
                    p_quantity_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        p_id_list[i] = jo.getString("itemID");
                        p_name_list[i] = jo.getString("itemName");
                        p_designer_list[i]=jo.getString("designer");
                        p_price_list[i] = jo.getString("price");
                        p_url_list[i] = "https://upcyclothes.duckdns.org/android" + jo.getString("URL");
                        p_detailUrl_list[i] = "https://upcyclothes.duckdns.org/android" + jo.getString("content");
                        p_quantity_list[i]=jo.getString("quantity");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}

