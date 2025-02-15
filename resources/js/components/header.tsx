import { cn } from '@/utils/classes';
import * as React from 'react';
import { Container } from 'ui';

const Header = React.forwardRef<HTMLDivElement, React.HTMLAttributes<HTMLDivElement>>(
    ({ className, ...props }, ref) => (
        <div ref={ref} className={cn('flex justify-between mb-20', className)} {...props}>
            <h1 className="text-2xl font-semibold">{props.title}</h1>
            <div className="flex space-x-4 items-center">
                <img src="https://cdn-icons-png.freepik.com/512/147/147133.png" alt="Logo" className="h-10" />
                <p className="text-lg font-semibold">Admin</p>
            </div>
        </div>
    )
);
Header.displayName = 'Header';

export { Header };
