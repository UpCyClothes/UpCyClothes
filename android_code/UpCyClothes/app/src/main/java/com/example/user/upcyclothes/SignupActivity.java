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
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by jinhee on 2018-10-05.
 */

public class SignupActivity extends AppCompatActivity {

    public static final Pattern VALID_PASSWOLD_REGEX_ALPHA_NUM = Pattern.compile("^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,16}$"); // 영숫특 8자리 ~ 16자리까지 가능
    public static final Pattern VALID_ID_REGEX_ALPHA_NUM = Pattern.compile("^(?=.*[a-zA-Z])(?=.*[0-9]).{4,12}$"); // 영숫자 4자리 ~ 12자리까지 가능

    private AlertDialog dialog;
    private boolean idValidate = false;
    private boolean nickValidate = false;
    private String emailChkResult ="0";
    private String idType ="0";
    private String tag1="";
    private String tag2="";
    private String phn1="";
    private boolean nickBtnOption=true;
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
        setContentView(R.layout.activity_signup);
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
                    Intent intent = new Intent(SignupActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(SignupActivity.this, MypageActivity.class);
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
                    Intent intent = new Intent(SignupActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(SignupActivity.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });
        spinner0= (Spinner) findViewById(R.id.tag0Combo);
        spinner1= (Spinner) findViewById(R.id.tag1Combo);
        final RadioGroup rg=(RadioGroup)findViewById(R.id.radioGroup1);
        RadioButton designer=(RadioButton)findViewById(R.id.designer);
        RadioButton customer=(RadioButton)findViewById(R.id.customer);
        //선택된 라디오버튼 값 반환 (회원 유형)
        rg.check(customer.getId());
        rg.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                // TODO Auto-generated method stub
                Log.v("라디오버튼"+checkedId+"이고","designer 값은 "+R.id.designer+"이다.");

                }

        });
        adapter0 = ArrayAdapter.createFromResource(SignupActivity.this, R.array.tagForCustomer, android.R.layout.simple_spinner_dropdown_item);
        adapter1 = ArrayAdapter.createFromResource(SignupActivity.this, R.array.tagForCustomer, android.R.layout.simple_spinner_dropdown_item);
        spinner0.setAdapter(adapter0);
        spinner1.setAdapter(adapter0);
        final EditText idText = (EditText) findViewById(R.id.idET);
        final EditText nameText = (EditText) findViewById(R.id.nameET);
        final EditText passwordText = (EditText) findViewById(R.id.pwET);
        passwordText.setInputType(InputType.TYPE_CLASS_TEXT | InputType.TYPE_TEXT_VARIATION_PASSWORD);
        final EditText passwordText2 = (EditText) findViewById(R.id.pwET2);
        passwordText2.setInputType(InputType.TYPE_CLASS_TEXT| InputType.TYPE_TEXT_VARIATION_PASSWORD);
        final EditText nickText = (EditText) findViewById(R.id.nickET);

        addrText1 = (TextView) findViewById(R.id.addrET);
        addrText2 = (TextView) findViewById(R.id.addrET1);
        addrText3 = (EditText) findViewById(R.id.addrET2);

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

                phn1=adapterView.getItemAtPosition(0).toString();
                Log.v("안눌림알림",phn1+ "is selected");
            }
        });

        final EditText phnText2 = (EditText) findViewById(R.id.phnET2);
        final EditText phnText3 = (EditText) findViewById(R.id.phnET3);
        final EditText emailText1 = (EditText) findViewById(R.id.emailET1);
        final EditText emailText2 = (EditText) findViewById(R.id.emailET2);

        final CheckBox checkBox = (CheckBox)findViewById(R.id.chkbox);
        checkBox.setOnClickListener(new Button.OnClickListener(){
            public void onClick(View v){
                if(checkBox.isChecked()){
                    emailChkResult="1";
                }
            }
        });



        //TAG1 선택 된 것

            spinner0.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                    if (spinner0.getSelectedItemPosition() >= 0) {
                        //선택된 항목
                        tag1 = i+1+ "";
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

        final ImageView validateIDButton = (ImageView) findViewById(R.id.chkIDBtn);
        validateIDButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view){
                String userID = idText.getText().toString();
                if(idValidate)
                {
                    return;
                }
                if(userID.equals(""))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                    dialog = builder.setMessage("ID cannot be blank.")
                            .setPositiveButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                else if(!validateID(userID)){
                    Toast.makeText(getApplicationContext(),"아이디의 형식이 맞지 않습니다. 영 대소문자, 숫자 4~12자리",Toast.LENGTH_LONG).show();
                        return;
                    }

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try
                        {
                            Log.d("Test : ",""+response);
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");
                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                                dialog = builder.setMessage("Available")
                                        .setPositiveButton("OK", null)
                                        .create();
                                dialog.show();
                                idText.setEnabled(false);
                                idValidate = true;
                            }
                            else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                                dialog = builder.setMessage("Not Available(Duplication)")
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
                ValidateRequest validateRequest = new ValidateRequest(userID,  responseListener);
                RequestQueue queue = Volley.newRequestQueue(SignupActivity.this);
                queue.add(validateRequest);
            }
        });
        final ImageView validateNickButton = (ImageView) findViewById(R.id.chkNickBtn);
        validateNickButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view){
                nickBtnOption=true;
                String userNick = nickText.getText().toString();
                if(nickValidate)
                {
                    return;
                }
                if(userNick.equals(""))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                    dialog = builder.setMessage("userNick cannot be blank.")
                            .setPositiveButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try
                        {
                            Log.d("Test nick : ",""+response);
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");
                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                                dialog = builder.setMessage("Available")
                                        .setPositiveButton("OK", null)
                                        .create();
                                dialog.show();
                                nickText.setEnabled(false);
                                nickValidate = true;
                            }
                            else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                                dialog = builder.setMessage("Not Available(Duplication)")
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
                ValidateRequest validateRequest = new ValidateRequest(userNick, nickBtnOption, responseListener);
                RequestQueue queue = Volley.newRequestQueue(SignupActivity.this);
                queue.add(validateRequest);
            }
        });

        //우편번호 버튼이 눌린 경우
        ImageView chkAddrBtn= (ImageView) findViewById(R.id.chkAddrBtn);
        chkAddrBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                Intent intent =  new Intent( SignupActivity.this, DaumWebViewActivity.class);
                startActivityForResult(intent,3000);

            }
        });

        //회원가입 버튼이 눌릴 경우
        Button registerButton = (Button) findViewById(R.id.signupBtn);
        registerButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view){
                RadioButton rd=(RadioButton)findViewById(rg.getCheckedRadioButtonId());
                Log.v("회원유형", rd.getText().toString());
                if(rd.getText().toString().equals("디자이너")){
                    idType=0+"";
                }
                else idType=1+"";

                if(!(passwordText.getText().toString().equals(passwordText2.getText().toString()))){ //pw와 pw 확인이 서로 같지 않으면
                    Toast.makeText(getApplicationContext(),"비밀번호와 비밀번호 확인이 같지 않습니다.",Toast.LENGTH_LONG).show();
                    return;
                }

                String userID = idText.getText().toString();
                String userPassword = passwordText.getText().toString();
                if(!validatePassword(userPassword)){
                    Toast.makeText(getApplicationContext(),"비밀번호의 형식이 맞지 않습니다. 영 대소문자, 숫자, 특수문자(!@.#$%^&*?_~) 8~16자리",Toast.LENGTH_LONG).show();
                    return;
                }

                String userName=nameText.getText().toString();
                String nickName=nickText.getText().toString();
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
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
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
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                    dialog = builder.setMessage("email 번호가 형식에 맞지 않습니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }


                if(!idValidate){
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                    dialog = builder.setMessage("Please check your ID")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                if(!nickValidate){
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                    dialog = builder.setMessage("Please check your nickname")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }

                if(userID.equals("") || userPassword.equals("") ||userName.equals("")||zipcode.equals("")||addr1.equals("")||phnNum.equals("")||email.equals("")){
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
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
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
                                dialog = builder.setMessage("Signed Up!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        finish();
                                    }
                                }).create();
                                dialog.show();

                            }
                            else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(SignupActivity.this);
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
                RegisterRequest registerRequest = new RegisterRequest(userID, userPassword, userName, nickName, idType, zipcode, addr1, addr2, phnNum, email, emailChkResult,tag1,tag2, responseListener);
                RequestQueue queue = Volley.newRequestQueue(SignupActivity.this);
                queue.add(registerRequest);
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

                case 2000:
                    Log.v("signup","상단 버튼눌릴경우");
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
     포맷 체크
     **/

    public static boolean validatePassword(String pwStr) {
        Matcher matcher = VALID_PASSWOLD_REGEX_ALPHA_NUM.matcher(pwStr);
        return matcher.matches();
    }
    public static boolean validateID(String pwStr) {
        Matcher matcher = VALID_ID_REGEX_ALPHA_NUM.matcher(pwStr);
        return matcher.matches();
    }
}


