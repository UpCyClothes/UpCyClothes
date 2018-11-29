package com.example.user.upcyclothes;

import android.app.Activity;
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
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MypageActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    private boolean newQuestion=false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mypage);
        //메시지에 대한 답장이 왔는지 확인해야함.
        LetsConnect letsConnect = new LetsConnect();
        letsConnect.checkAnswer();
        letsConnect.checkQuestion();
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
                Toast.makeText(MypageActivity.this,"현재 페이지입니다.",Toast.LENGTH_LONG).show();
                return;
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //장바구니 고고
                Intent intent = new Intent(MypageActivity.this, MycartActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);
            }

        });
        TextView idTV= (TextView)findViewById(R.id.idTV);
        idTV.setText(MainActivity.userID+" 고객님");

        Button modifyBtn = (Button)findViewById(R.id.modifyBtn);
        Button mycartBtn = (Button)findViewById(R.id.mycartBtn);
        Button orderBtn = (Button)findViewById(R.id.orderBtn);
        Button messengerBtn = (Button)findViewById(R.id.messengerBtn);
        ImageView newBtn = (ImageView)findViewById(R.id.newBtn);

        if(MessengerActivity.newMessage){
            //메신저액티비티보다 먼저 뉴됐을 경우도 고려해야함
            newBtn.setVisibility(View.VISIBLE);
        }

        Button logoutBtn = (Button)findViewById(R.id.logoutBtn);
        RelativeLayout layout= (RelativeLayout)findViewById(R.id.rl1);
        if(LoginActivity.designerFlag){
            layout.setVisibility(View.VISIBLE);
        }
        Button answerBtn =(Button)findViewById(R.id.answerBtn);
        ImageView newBtn4Answer = (ImageView)findViewById(R.id.newBtn4Answer);
        if(newQuestion){
            newBtn4Answer.setVisibility(View.VISIBLE);
        }

        modifyBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Log.v("개인정보수정 버튼","눌림");
                Intent intent = new Intent(MypageActivity.this, ModifyInfo.class);
                startActivity(intent);

            }
        });
        mycartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Log.v("장바구니 버튼","눌림");
                Intent intent = new Intent(MypageActivity.this, MycartActivity.class);
                startActivity(intent);

            }
        });
        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Intent intent = new Intent(MypageActivity.this, MyOrderActivity.class);
                startActivity(intent);

            }
        });
        messengerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Intent intent = new Intent(MypageActivity.this, MessengerActivity.class);
                startActivity(intent);
                finish();

            }
        });
        logoutBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //세션 정보 지우기
                MainActivity.userID=null;
                Intent intent = new Intent(MypageActivity.this, MainActivity.class);
                startActivity(intent);
                finish();

            }
        });
        answerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Log.v("답장하기","눌림");
                Intent intent = new Intent(MypageActivity.this, AnswerActivity.class);
                startActivity(intent);
                finish();
            }
        });
    }
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_new) {
            // Handle the camera action
            Intent intent = new Intent(MypageActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(MypageActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(MypageActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(MypageActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(MypageActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(MypageActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(MypageActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(MypageActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(MypageActivity.this,CommunityActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(MypageActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private class LetsConnect {
        //서버에서 아이템이름, 아이템유알엘, 제목, 내용, 답변 받아오기.

        protected void checkAnswer() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/checkAnswer.php", "userID=" + MainActivity.userID, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            if (result.contains("true")) {
                MessengerActivity.newMessage = true;
            }
            else MessengerActivity.newMessage = false;
        }
        protected void checkQuestion() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/checkQuestion.php", "designerID=" + LoginActivity.designNick, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            if (result.contains("true")) {
                newQuestion= true;
            }
            else newQuestion= false;
        }

    }
}
