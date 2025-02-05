import { GuestLayout } from '@/layouts/guest-layout';
import { Link, useForm } from '@inertiajs/react';
import React, { useEffect } from 'react';
import { toast, Toaster } from 'sonner';
import { Button, TextField } from 'ui';

interface LoginProps {
  status: string;
  canResetPassword: boolean;
}

export default function Login(args: LoginProps) {

  const { data, setData, post, processing, errors, reset } = useForm({
    email: '',
    password: '',
    // remember: ''
  });

  useEffect(() => {
    return () => {
      reset('password');
    };
  }, []);

  const submit = (e: { preventDefault: () => void }) => {
    e.preventDefault();

    post(route('web.auth.attempt'), {
        onSuccess: () => {
            toast.success('Login successfully');
        },
        onError: (error) => {
            toast('Whoopsss....', {
                description: JSON.stringify(error)
            });
        }
    });
  };

  return (
    <>
      <Toaster />
      <div className='container relative grid h-svh flex-col items-center justify-center lg:max-w-none lg:grid-cols-2 lg:px-0'>
        <div className='relative hidden h-full flex-col bg-muted p-10 text-white dark:border-r lg:flex'>
          <img className='absolute inset-0 h-screen object-cover w-full' src="https://images.unsplash.com/photo-1670680342823-4fe90ffb0d2f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" />
          <div className='absolute inset-0 h-screen w-full bg-zinc-900 opacity-50' />
          <div className='relative z-20 flex items-center text-lg font-medium'>
            Ojek Online
          </div>
          <div className='relative z-20 mt-auto'>
            <blockquote className='space-y-2'>
              <p className='text-lg'>
                good delivering insight driven by data, kudos retha
              </p>
              <footer className='text-sm'></footer>
            </blockquote>
          </div>
        </div>
        <div className='lg:p-8'>
          <form onSubmit={submit} className='mx-auto flex w-full flex-col justify-center sm:max-w-md'>
            <div className='flex flex-col space-y-2 text-left mb-4'>
              <h1 className='text-2xl font-semibold tracking-tight'>Login</h1>
              <p className='text-sm text-muted-foreground'>
                Enter your email and password below <br />
                to log into your account
              </p>
            </div>
            <TextField
              label="Email"
              type="email"
              name="email"
              value={data.email}
              autoComplete="one-time-code"
              onChange={(v) => setData("email", v)}
              errorMessage={errors.email}
              isRequired
              className='mb-2'
            />
            <TextField
              isRevealable
              label="Password"
              type="password"
              name="password"
              value={data.password}
              autoComplete="one-time-code"
              onChange={(v) => setData("password", v)}
              errorMessage={errors.password}
              isRequired
              className='mb-2'
            />
            <Button intent='custom' isDisabled={processing} className="mt-3" type="submit">
              Login
            </Button>
          </form>
        </div>
      </div>
    </>
  );
}

Login.layout = (page: React.ReactNode) => <GuestLayout children={page} />;
