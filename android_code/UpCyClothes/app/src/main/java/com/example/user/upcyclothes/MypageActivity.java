package com.example.user.upcyclothes;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MypageActivity extends Activity {
    private boolean newQuestion=false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mypage);
        //메시지에 대한 답장이 왔는지 확인해야함.
        LetsConnect letsConnect = new LetsConnect();
        letsConnect.checkAnswer();
        letsConnect.checkQuestion();

        TextView idTV= (TextView)findViewById(R.id.idTV);
        idTV.setText(MainActivity.userID+" 고객님");

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

        mycartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Log.v("장바구니 버튼","눌림");
                Intent intent = new Intent(MypageActivity.this, MycartActivity.class);
                startActivity(intent);
                finish();

            }
        });
        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Intent intent = new Intent(MypageActivity.this, MyOrderActivity.class);
                startActivity(intent);
                finish();

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
