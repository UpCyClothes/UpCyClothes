package com.example.user.upcyclothes;


import android.content.Context;
import android.content.res.Resources;
import android.support.v4.content.ContextCompat;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.ArrayList;


public class cartItemAdapter  extends ArrayAdapter implements View.OnClickListener{

    private Context context;

    private String[] itemName;
    private String[] price;
    private String[] amount;
    private String[] url;
    boolean selectChk=false;

    Button deleteBtn;
    public interface ListBtnClickListener {
        void onListBtnClick(int position) ;
    }


    // 생성자로부터 전달된 resource id 값을 저장.
    int resourceId ;
    // 생성자로부터 전달된 ListBtnClickListener  저장.
    private ListBtnClickListener listBtnClickListener ;


    // ListViewBtnAdapter 생성자. 마지막에 ListBtnClickListener 추가.
    cartItemAdapter(Context context, int resource, String[] s1,String[] s2, String[] s3, String s4[],  ListBtnClickListener clickListener) {
        super(context, resource) ;

        // resource id 값 복사. (super로 전달된 resource를 참조할 방법이 없음.)
        this.resourceId = resource ;

        this.listBtnClickListener = clickListener ;
        this.itemName=s1;
        this.price=s2;
        this.amount=s3;
        this.url=s4;
    }
//
//    public  cartItemAdapter (Context con, String[] s1, String[] s2, String[] s3, String[] s4){
//
//        this.context=con;
//
//        this.itemName=s1;
//        this.price=s2;
//        this.amount=s3;
//        this.url=s4;
//    };
    @Override
    public int getCount() {
        return itemName.length;
    }

    @Override
    public String[] getItem(int pos){
        String[] item= new String[4];
        item[0]=itemName[pos];
        item[1]=price[pos];
        item[2]=amount[pos];
        item[3]=url[pos];
        return item;
    }

    @Override
    public  long getItemId(int pos){
        return pos;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final int pos = position ;
        final Context context = parent.getContext();

        // 생성자로부터 저장된 resourceId(listview_btn_item)에 해당하는 Layout을 inflate하여 convertView 참조 획득.
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(this.resourceId/*R.layout.activity_cart_item*/, parent, false);
        }
        //(cartItem).setData(itemName[pos],price[pos],amount[pos],url[pos]);
//        // 화면에 표시될 View(Layout이 inflate된)로부터 위젯에 대한 참조 획득
        final TextView itemNameTV = (TextView) convertView.findViewById(R.id.itemNameTV);
        final TextView priceTV = (TextView) convertView.findViewById(R.id.priceTV);
        final TextView amountTV = (TextView) convertView.findViewById(R.id.amountTV);
        final ImageView itemImg=(ImageView)convertView.findViewById(R.id.itemImg);

        itemNameTV.setText(itemName[pos]);
        priceTV.setText(price[pos]);
        amountTV.setText(amount[pos]);
        Glide.with(convertView).load(url[pos]).into(itemImg);

        // Data Set(listViewItemList)에서 position에 위치한 데이터 참조 획득
        //final cartItem listViewItem = (cartItem) getItem(position);

//        // 아이템 내 각 위젯에 데이터 반영
//        iconImageView.setImageDrawable(listViewItem.getIcon());
//        textTextView.setText(listViewItem.getText());

        // selectBtn 클릭 시 아이콘의 색 변경.
       final ImageView selectBtn;
        final ImageView nonselectBtn;
        selectBtn = (ImageView) convertView.findViewById(R.id.selectBtn);
        nonselectBtn = (ImageView) convertView.findViewById(R.id.nonselectBtn);
        selectBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                   //selectBtn.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.select));
                    //selectBtn.setImageResource(R.drawable.select);
                    selectChk = false;
                    selectBtn.setVisibility(View.INVISIBLE);
                    nonselectBtn.setVisibility(View.VISIBLE);
                    Log.v("선택버튼","비활성화");
                }
        });
        nonselectBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                //selectBtn.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.select));
                //selectBtn.setImageResource(R.drawable.select);
                selectChk = true;
                selectBtn.setVisibility(View.VISIBLE);
                nonselectBtn.setVisibility(View.INVISIBLE);
                Log.v("선택버튼","활성화");
            }
        });


        // button2의 TAG에 position값 지정. Adapter를 click listener로 지정.
        Button deleteBtn = (Button) convertView.findViewById(R.id.deleteBtn);
        deleteBtn.setTag(position);
        deleteBtn.setOnClickListener(this);

        return convertView;
    }

    // deleteBtn이  눌려졌을 때 실행되는 onClick함수.
    public void onClick(View v) {
        // ListBtnClickListener(MainActivity)의 onListBtnClick() 함수 호출.
        if (this.listBtnClickListener != null) {
            this.listBtnClickListener.onListBtnClick((int)v.getTag()) ;
        }
    }

}

