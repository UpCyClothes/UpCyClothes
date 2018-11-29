package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MessengerActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    static boolean newMessage;
    private String user_ID;
    private ListView mListView;
    private String[] messengerID;

    private String[] designerID;
    private String[] unread;

    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

            Intent intent = new Intent(MessengerActivity.this, MessageListActivity.class);

            intent.putExtra("userID",user_ID);
            intent.putExtra("designerID",designerID[arg2]);
            startActivity(intent);
            finish();
            //컨텐트내용은 다음에서 받을거임.
        }
    };
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_messenger);
        //여기도 로그인이 되어있는지 체크해야함.
        TextView idTV = (TextView)findViewById(R.id.idTV);
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


        if(MainActivity.userID==null){
            //로그인이 필요한 서비스입니다. 창 띄워주기.
            Log.v("userid는  ",user_ID+"없다.");
            new android.app.AlertDialog.Builder(this)
                    .setIcon(android.R.drawable.ic_dialog_alert)
                    .setTitle("알림")
                    .setMessage("로그인이 필요한 서비스입니다.")
                    .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(MessengerActivity.this, LoginActivity.class);
                            startActivityForResult(intent,2000);
                        }
                    })
                    .show();

        }
        else {
            user_ID=MainActivity.userID;
            idTV.setText(user_ID);
            mListView = (ListView) findViewById(R.id.listview);
            mListView.setOnItemClickListener(listviewOnItemClickListener);

            LetsConnect letsConnect = new LetsConnect();
            letsConnect.getItemInfo();

            dataSetting();
            //툴바의 버튼
            // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
            final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
            final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
            //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

            //툴바 버튼리스너
            personBtn.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                        //마이페이지 고고
                        Intent intent = new Intent(MessengerActivity.this, MypageActivity.class);
                        //intent.putExtra("sauce name",name );
                        //intent.putExtra("userID",userID);
                        startActivity(intent);

                }
            });
            cartBtn.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                        Intent intent = new Intent(MessengerActivity.this, MycartActivity.class);
                        startActivity(intent);
                    }

            });
        }
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
            Intent intent = new Intent(MessengerActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(MessengerActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(MessengerActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(MessengerActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(MessengerActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(MessengerActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(MessengerActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(MessengerActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(MessengerActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(MessengerActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private void dataSetting(){
        //여기서 서버 값 정리해서 보내주기
       int cnt=0;
       boolean[] unreadflag= new boolean[designerID.length];
        for(int i=0;i<designerID.length;i++){
            if(Integer.parseInt(unread[i])==2 ){
                unreadflag[i]=true;
                cnt++;
            }
            else {
                unreadflag[i]=false;
            }
        }
        if(cnt>0){
            newMessage=true;
        }
        else {
            newMessage=false;
        }

        messAdapter mAdapter= new messAdapter(designerID,unreadflag);
        //정보를 보내줍니다.

        mListView.setAdapter(mAdapter);
    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/getDesignerList.php", "user_ID="+user_ID,false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
        }

        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    messengerID=new String[Integer.parseInt(num)];
                    designerID=new String[Integer.parseInt(num)];
                    unread=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        messengerID[i]=jo.getString("messengerID");
                        designerID[i]=jo.getString("designerID");
                        unread[i]=jo.getString("unread");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
