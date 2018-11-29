package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;

import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;

public class QuestionActivity extends AppCompatActivity {

    private AlertDialog dialog;

    private String item_id;
    private String item_name;
    private String item_designer;
    private String url;
    private String subject;
    private String content;
    private String readOrNot;
    private String userid;
    private String date;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_question);
        Intent intent = getIntent();
        item_id = (intent.getStringExtra("item id"));
        item_name = intent.getStringExtra("item name");
        item_designer = intent.getStringExtra("designer");
        url= intent.getStringExtra("url");

        ImageView thumbnail = (ImageView) findViewById(R.id.thumbnail);
        Glide.with(this).load(url).into(thumbnail);
        TextView itemInfo = (TextView) findViewById(R.id.itemInfo);
        itemInfo.setText(item_name);
        final EditText subjectET = (EditText) findViewById(R.id.subjectET);
        final EditText contentET = (EditText) findViewById(R.id.contentET);
        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(QuestionActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }

        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(QuestionActivity.this, MycartActivity.class);
                    startActivity(intent);
                }

        });
        Button completeBtn = (Button) findViewById(R.id.completeBtn);
        completeBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //사용자가 작성한 값을 저장한다.
                subject = subjectET.getText().toString();
                Log.v("subject",subject);
                content = contentET.getText().toString();
                Log.v("content",content);
                userid = MainActivity.userID;
                readOrNot="0";
                date=getCurrentTimeStamp();

                //서버에 정보를 넘긴다. date, userid, designerid,subject content item id 답변여부 0으로 세팅
                if (subject.equals("") || content.equals("")) {
                    AlertDialog.Builder builder = new AlertDialog.Builder(QuestionActivity.this);
                    dialog = builder.setMessage("제목과 내용은 필수입력사항입니다.")
                            .setPositiveButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            Log.v("response",response);
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");
                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(QuestionActivity.this);
                                dialog = builder.setMessage("문의가 등록되었습니다.").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        finish();
                                    }
                                }).create();
                                dialog.show();


                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(QuestionActivity.this);
                                dialog = builder.setMessage("문의등록에 실패하였습니다. 다시한번 시도해주세요.")
                                        .setNegativeButton("OK", null)
                                        .create();
                                dialog.show();
                            }
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                };
                QuestionRequest questionRequest = new QuestionRequest(item_id,date,subject,content,"",userid,item_designer,readOrNot, responseListener);
                RequestQueue queue = Volley.newRequestQueue(QuestionActivity.this);
                queue.add(questionRequest);
            }
        });

        //
    }
    public String getCurrentTimeStamp() {
        return new SimpleDateFormat("yyyy-MM-dd HH:mm:ss.SSS").format(new Date());
    }
}
