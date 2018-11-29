package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by jinhee on 2018-10-05.
 */

public class ModifyInfo extends AppCompatActivity {

    public static final Pattern VALID_PASSWOLD_REGEX_ALPHA_NUM = Pattern.compile("^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,16}$"); // 영숫특 8자리 ~ 16자리까지 가능

    private AlertDialog dialog;

    private String emailChkResult ="0";
    private String userName;
    private String addr1;
    private String addr2;
    private String zip;
    private String tel;
    private String email;
    private String recep;
    private String tag1;
    private String tag2;
    private String phn1;

    private TextView addrText1;
    private TextView addrText2;
    private EditText addrText3;
    ArrayAdapter adapter0;
    ArrayAdapter adapter1;
    Spinner spinner0;
    Spinner spinner1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_modify_info);
        //아이디,닉네임, 유저타입은 변경 불가능.
        //기존의 유저 정보 불러와 세팅하기
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
                    Intent intent = new Intent(ModifyInfo.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }

        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(ModifyInfo.this, MycartActivity.class);
                    startActivity(intent);

            }
        });
        final LetsConnect letsConnect= new LetsConnect();
        letsConnect.getItemInfo();

        spinner0= (Spinner) findViewById(R.id.tag0Combo);
        spinner1= (Spinner) findViewById(R.id.tag1Combo);


        adapter0 = ArrayAdapter.createFromResource(ModifyInfo.this, R.array.tagForCustomer, android.R.layout.simple_spinner_dropdown_item);
        adapter1 = ArrayAdapter.createFromResource(ModifyInfo.this, R.array.tagForCustomer, android.R.layout.simple_spinner_dropdown_item);
        spinner0.setAdapter(adapter0);
        spinner1.setAdapter(adapter0);
        //기본값세팅
        spinner0.setSelection(Integer.parseInt(tag1)-1);
        spinner1.setSelection(Integer.parseInt(tag2)-1);

        final EditText nameText = (EditText) findViewById(R.id.nameET);
        nameText.setText(userName);
        final EditText passwordText = (EditText) findViewById(R.id.pwET);
        passwordText.setInputType(InputType.TYPE_CLASS_TEXT | InputType.TYPE_TEXT_VARIATION_PASSWORD);
        final EditText passwordText2 = (EditText) findViewById(R.id.pwET2);
        passwordText2.setInputType(InputType.TYPE_CLASS_TEXT| InputType.TYPE_TEXT_VARIATION_PASSWORD);

        addrText1 = (TextView) findViewById(R.id.addrET);
        addrText2 = (TextView) findViewById(R.id.addrET1);
        addrText3 = (EditText) findViewById(R.id.addrET2);
        //기본값세팅
        addrText1.setText(zip);
        addrText2.setText(addr1);
        addrText3.setText(addr2);

        final Spinner phnSpn1= (Spinner) findViewById(R.id.phn1);
        final ArrayAdapter adtPhn=ArrayAdapter.createFromResource(this, R.array.tagForPhn,android.R.layout.simple_spinner_dropdown_item);

        phnSpn1.setAdapter(adtPhn);
        phnSpn1.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                if(phnSpn1.getSelectedItemPosition() >= 0){
                    //선택된 항목
                    phn1=adapterView.getItemAtPosition(i).toString();
                    Log.v("알림",adapterView.getItemAtPosition(i).toString()+ "is selected");
                }
            }  @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                //서버에서 받은 유저의 정보값으로 기본 세팅
                phn1=adapterView.getItemAtPosition(0).toString();
                phn1=tel.substring(0,2);
                Log.v("phn1",phn1);

                for(int i=0;i<5;i++){
                    if(adtPhn.getItem(i).equals(phn1)){
                        phnSpn1.setSelection(i);
                        break;
                    }
                }
                Log.v("안눌림알림",phn1+ "is selected");
            }
        });

        final EditText phnText2 = (EditText) findViewById(R.id.phnET2);
        final EditText phnText3 = (EditText) findViewById(R.id.phnET3);
        //기본값세팅
        if(tel.length()==10){
            Log.v("10자리번호",tel.substring(3,6));
            phnText2.setText(tel.substring(3,6));
            phnText3.setText(tel.substring(6,10));
        }
        else if(tel.length()==11){

            Log.v("11자리번호",tel.substring(3,7));
            phnText2.setText(tel.substring(3,7));
            phnText3.setText(tel.substring(7,11));
        }
        final EditText emailText1 = (EditText) findViewById(R.id.emailET1);
        final EditText emailText2 = (EditText) findViewById(R.id.emailET2);
        //기본값세팅
        emailText1.setText(email.split("@")[0]);
        emailText2.setText(email.split("@")[1]);
        final CheckBox checkBox = (CheckBox)findViewById(R.id.chkbox);
        if (recep.equals("0")){
            Log.v("if :reception",recep);

            checkBox.setChecked(false);
        }
        else{

            Log.v("else :reception",recep);
            checkBox.setChecked(true);
        }
        checkBox.setOnClickListener(new Button.OnClickListener(){
            public void onClick(View v){
                if(checkBox.isChecked()){
                    emailChkResult="1";
                }
            }
        });

        //푸시알림 수신여부
        final CheckBox checkBox2 = (CheckBox)findViewById(R.id.chkbox2);
        if(MainActivity.pushFlag==true){
            Log.v("modifychech","pushflag=true");
            checkBox2.setChecked(true);
        }
        checkBox2.setOnClickListener(new Button.OnClickListener(){
            public void onClick(View v){
                if(checkBox2.isChecked()){
                    MainActivity.pushFlag=true;
                }
                else {
                    MainActivity.pushFlag=false;
                }
            }
        });

        //TAG1 선택 된 것

        spinner0.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                if (spinner0.getSelectedItemPosition() >= 0) {
                    //선택된 항목
                    tag1 = i +1+ "";
                    Log.v("알림1", i + "is selected");
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                tag1 = 1 + "";
            }
        });


        //TAG2

        spinner1.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                if (spinner1.getSelectedItemPosition() >= 0) {
                    //선택된 항목
                    tag2 = i +1+ "";
                    Log.v("알림2", i + "is selected");
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

                tag2 = 1 + "";
            }
        });

        //우편번호 버튼이 눌린 경우
        ImageView chkAddrBtn= (ImageView) findViewById(R.id.chkAddrBtn);
        chkAddrBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                Intent intent =  new Intent( ModifyInfo.this, DaumWebViewActivity.class);
                startActivityForResult(intent,3000);
            }
        });


        //수정 버튼이 눌릴 경우
        Button registerButton = (Button) findViewById(R.id.signupBtn);
        registerButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view){

                if(!(passwordText.getText().toString().equals(passwordText2.getText().toString()))){ //pw와 pw 확인이 서로 같지 않으면
                    Toast.makeText(getApplicationContext(),"비밀번호와 비밀번호 확인이 같지 않습니다.",Toast.LENGTH_LONG).show();
                    return;
                }

                String userPassword = passwordText.getText().toString();
                if(!validatePassword(userPassword)){
                    Toast.makeText(getApplicationContext(),"비밀번호의 형식이 맞지 않습니다. 영 대소문자, 숫자, 특수문자(!@.#$%^&*?_~) 8~16자리",Toast.LENGTH_LONG).show();
                    return;
                }

                String userName=nameText.getText().toString();
                String zipcode=addrText1.getText().toString();
                String addr1=addrText2.getText().toString();
                String addr2=addrText3.getText().toString();
                String phnNum="";
                String email="";


                if((phnText2.length()==4 || phnText2.length()==3) && (phnText3.length()==4)){
                    //4자리인지 확인
                    phnNum=phn1+phnText2.getText().toString()+phnText3.getText().toString();;
                }
                else {
                    AlertDialog.Builder builder = new AlertDialog.Builder(ModifyInfo.this);
                    dialog = builder.setMessage("phone 번호가 형식에 맞지 않습니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }

                if(checkEmail(emailText1.getText().toString()+"@"+emailText2.getText().toString())){
                    email= emailText1.getText().toString()+"@"+emailText2.getText().toString();
                }
                else {
                    AlertDialog.Builder builder = new AlertDialog.Builder(ModifyInfo.this);
                    dialog = builder.setMessage("email 번호가 형식에 맞지 않습니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }


                if(userPassword.equals("") ||userName.equals("")||zipcode.equals("")||addr1.equals("")||phnNum.equals("")||email.equals("")){
                    AlertDialog.Builder builder = new AlertDialog.Builder(ModifyInfo.this);
                    dialog = builder.setMessage("모든 항목이 채워지지 않았습니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                //서버에 정보 보내기
                Response.Listener<String> responseListener = new Response.Listener<String>() {

                    @Override
                    public void onResponse(String response) {
                        try
                        {
                            Log.v("response",response);
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");
                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(ModifyInfo.this);
                                dialog = builder.setMessage("수정이 완료되었습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        finish();
                                    }
                                }).create();
                                dialog.show();

                            }
                            else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(ModifyInfo.this);
                                dialog = builder.setMessage("Failed - Try One more!")
                                        .setNegativeButton("OK", null)
                                        .create();
                                dialog.show();
                            }
                        }
                        catch (Exception e){
                            e.printStackTrace();
                        }
                    }
                };
                RegisterRequest registerRequest = new RegisterRequest(MainActivity.userID,userPassword, userName, zipcode, addr1, addr2, phnNum, email, emailChkResult,tag1,tag2, responseListener);
                RequestQueue queue = Volley.newRequestQueue(ModifyInfo.this);
                queue.add(registerRequest);
            }
        });

        //탈퇴 버튼이 눌린 경우
        Button leaveBtn= (Button) findViewById(R.id.leaveBtn);
        leaveBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                Log.v("왜 그냥 꺼지는거야...","");
                LetsConnect l= new LetsConnect();
                l.leave();
                MainActivity.userID=null;

            }
        });
    }
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 3000:
                    addrText1.setText(data.getStringExtra("addr1"));
                    addrText1.setEnabled(false);
                    addrText2.setText(data.getStringExtra("addr2"));
                    addrText2.setEnabled(false);
                    break;
            }
        }
    }
    @Override
    protected void onStop(){
        super.onStop();
        if(dialog != null)
        {
            dialog.dismiss();
            dialog = null;
        }

    }

    /**
     이메일 포맷 체크
     **/
    public static boolean checkEmail(String email){

        String regex = "^[_a-zA-Z0-9-\\.]+@[\\.a-zA-Z0-9-]+\\.[a-zA-Z]+$";
        Pattern p = Pattern.compile(regex);
        Matcher m = p.matcher(email);
        boolean isNormal = m.matches();
        return isNormal;
    }
    /**
     비밀번호 포맷 체크
     **/

    public static boolean validatePassword(String pwStr) {
        Matcher matcher = VALID_PASSWOLD_REGEX_ALPHA_NUM.matcher(pwStr);
        return matcher.matches();
    }



    private class LetsConnect {

        protected void getItemInfo() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/getUserInfo.php", "userID=" + MainActivity.userID, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            parsingItem(result);
        }
        protected void leave() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/leave.php", "userID=" + MainActivity.userID+"&nickname="+LoginActivity.designNick, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            try
            {
                Log.v("result",result);
                JSONObject jsonResponse = new JSONObject(result);
                boolean success = jsonResponse.getBoolean("success");
                if (success) {
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(ModifyInfo.this);
                    dialog = builder.setMessage("탈퇴되었습니다.").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            finish();
                        }
                    }).create();
                    dialog.show();

                }
                else{
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(ModifyInfo.this);
                    dialog = builder.setMessage("서버오류! 다시 한 번 실행해주세요.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                }
            }
            catch (Exception e){
                e.printStackTrace();
            }
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

                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        userName = jo.getString("userName");
                        addr1 = jo.getString("address1");
                        addr2 = jo.getString("address2");
                       zip = jo.getString("zipcode");
                        tel= jo.getString("tel");
                        email = jo.getString("Email");
                        recep = jo.getString("reception");
                        tag1 = jo.getString("tag1");
                        tag2 = jo.getString("tag2");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

}


