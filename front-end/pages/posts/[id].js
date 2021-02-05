import Head from 'next/head'
import axios from 'axios'
import Sidebar from "../../components/shared/Sidebar";
import {Breadcrumb, Layout} from "antd";
import React, {useState} from 'react';
import 'antd/dist/antd.css';
import {Form, Input, Button, Radio} from 'antd';
import FormBuilder from 'antd-form-builder'


const {Header, Content, Footer} = Layout;

export default function Post() {
    const meta = {
        fields: [
            { key: 'username', label: 'User Name' },
            { key: 'password', label: 'Password', widget: 'password' },
        ],
    }

    const handleFinish = React.useCallback(values => {
        console.log('Submit: ', values)
    }, [])

    return (
        <Layout>
            <Sidebar/>
            <Layout style={{padding: '0 24px 24px'}}>
                <Breadcrumb style={{margin: '16px 0'}}>
                    <Breadcrumb.Item>Home</Breadcrumb.Item>
                    <Breadcrumb.Item>App</Breadcrumb.Item>
                </Breadcrumb>
                <Content  className="site-layout-background"
                          style={{
                              padding: 24,
                              margin: 0,
                              minHeight: 680,
                          }}
                >
                    <Form onFinish={handleFinish}>
                        <FormBuilder meta={meta} />
                        <Form.Item wrapperCol={{ span: 16, offset: 8 }}>
                            <Button type="primary" htmlType="submit">
                                Log in ADMIN
                            </Button>
                        </Form.Item>
                    </Form>
            </Content>

            </Layout>

        </Layout>
    )
}