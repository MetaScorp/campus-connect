package com.campusconnect.sit.ui.fragments;

import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.view.ViewPager;
import android.support.v7.widget.Toolbar;
import android.view.View;

import com.campusconnect.sit.R;
import com.campusconnect.sit.base.BaseFragment;
import com.campusconnect.sit.misc.utils.StudentNoticePager;


public class SNoticesFragment extends BaseFragment {

    private ViewPager viewPager;
    private TabLayout tabLayout;
    private Toolbar toolbar;
    private StudentNoticePager studentNoticePager;

    /**
     * Instance of this class
     * @return
     */
    public static SNoticesFragment getInstance(){
        return new SNoticesFragment();
    }

    @Override
    protected int layoutId() {
        return R.layout.fragment_snotice;
    }

    @Override
    protected void ui(View rootview) {
        toolbar = (Toolbar) rootview.findViewById(R.id.toolbar);
        tabLayout = (TabLayout) rootview.findViewById(R.id.tabLayout);
        viewPager = (ViewPager) rootview.findViewById(R.id.pager);
    }

    @Override
    protected void function() {
        toolbar.setTitle(getString(R.string.notices));
        toolbar.showOverflowMenu();
        setHasOptionsMenu(true);
        studentNoticePager = new StudentNoticePager(getContext(), getChildFragmentManager());
        //Adapted is set in viewpager
        viewPager.setAdapter(studentNoticePager);
        //tablayout is set work with viewpager
        tabLayout.setupWithViewPager(viewPager);
    }

    @Override
    protected Fragment setfragment() {
        return null;
    }

    @Override
    protected int setContainerId() {
        return 0;
    }
}
