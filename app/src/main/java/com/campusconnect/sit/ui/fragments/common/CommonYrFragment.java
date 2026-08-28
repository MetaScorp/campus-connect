package com.campusconnect.sit.ui.fragments.common;

import android.support.v4.app.Fragment;
import android.support.v7.widget.AppCompatButton;
import android.support.v7.widget.Toolbar;
import android.text.TextUtils;
import android.view.View;

import com.campusconnect.sit.R;
import com.campusconnect.sit.base.BaseFragment;
import com.campusconnect.sit.misc.utils.Extras;
import com.campusconnect.sit.ui.activities.MainActivity;
import com.campusconnect.sit.ui.fragments.NoticeFragment;
import com.campusconnect.sit.ui.fragments.year.FirstYearFragment;
import com.campusconnect.sit.ui.fragments.year.FourthYearFragment;


public class CommonYrFragment extends BaseFragment {

    private Toolbar toolbar;
    private AppCompatButton firstyear,secondyear,thirdyear,fourthyear,notices;
    private static String toolbarTitle;
    private Extras prefernces;

    /**
     * Instance of this class
     * @return
     */
    public  static CommonYrFragment getInstance(String toolbarTitle){
        setToolbarTitle(toolbarTitle);
        return new CommonYrFragment();
    }

    @Override
    protected int layoutId() {
        return R.layout.common_yr;
    }

    @Override
    protected void ui(View rootview) {
        toolbar = (Toolbar) rootview.findViewById(R.id.toolbar);
        firstyear = (AppCompatButton) rootview.findViewById(R.id.firstYear);
        secondyear = (AppCompatButton) rootview.findViewById(R.id.secondYear);
        thirdyear = (AppCompatButton) rootview.findViewById(R.id.thirdYear);
        fourthyear = (AppCompatButton) rootview.findViewById(R.id.fourthYear);
        notices = (AppCompatButton) rootview.findViewById(R.id.notices);
    }

    @Override
    protected void function() {
        toolbar.setTitle(getToolbarTitle());
        firstyear.setOnClickListener(onClick);
        secondyear.setOnClickListener(onClick);
        thirdyear.setOnClickListener(onClick);
        fourthyear.setOnClickListener(onClick);
        notices.setOnClickListener(onClick);
        prefernces = new Extras(getContext());
    }

    @Override
    protected Fragment setfragment() {
        return null;
    }

    @Override
    protected int setContainerId() {
        return ((MainActivity) getActivity()).setContainerId();
    }

    private View.OnClickListener onClick = new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            switch (view.getId()){
                case R.id.firstYear:
                    fragmentLoader(FirstYearFragment.getInstance("First Year"));
                    break;
                case R.id.secondYear:
                    break;
                case R.id.thirdYear:
                    break;
                case R.id.fourthYear:
                    if (!TextUtils.isEmpty(prefernces.getBranchCmpn())){
                        if (prefernces.getBranchCmpn().equals("cmpn")){
                            prefernces.setfourthYear(false);
                            fragmentLoader(FourthYearFragment.getInstances("Fourth Year"));
                        }
                    }
                    break;
                case R.id.notices:
                    if (!TextUtils.isEmpty(prefernces.getBranchCmpn())){
                        if (prefernces.getBranchCmpn().equals("cmpn")){
                            fragmentLoader(NoticeFragment.getInstance(false, true, "cmpnupload"));
                        }
                    }
                    break;

            }
        }
    };

    public static String getToolbarTitle() {
        return toolbarTitle;
    }

    public static void setToolbarTitle(String toolbarTitles) {
        toolbarTitle = toolbarTitles;
    }

    private void fragmentLoader(Fragment fragment){
        getFragmentManager().beginTransaction().replace(setContainerId(), fragment).addToBackStack(null).commit();
    }
}
